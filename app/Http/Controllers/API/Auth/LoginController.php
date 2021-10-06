<?php

namespace App\Http\Controllers\API\Auth;

use Log;
use Sentinel;
use Authy\AuthyApi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\LoginPasswordRequest;


class LoginController extends Controller
{
    const AUTHY_SMS_CANCELLED    = 0;
    const AUTHY_SMS_SUCCESS      = 1;
    const AUTHY_SMS_FAILED       = 2;

    /**
     * Login API
     * 
     * This endpoint allows you to login users.
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $response = [];
        $credentials = $this->processCredentials($request);
        # attempt to login
        if ($user = Sentinel::stateless($credentials)) {            
            if ($user->hasMFA() && $this->notLocal() && $this->hasAuthyConfig()) {
                // If has phone number
                $verify = $this->sendOTP($user);
                switch ($verify) {
                    case self::AUTHY_SMS_SUCCESS:
                        return response()->success(['verify' => true]);
                        break;
                    case self::AUTHY_SMS_CANCELLED:
                        return response()->success([
                            'token' => $user->createToken(config('app.name') . ': ' . $user->username)->accessToken,
                            'mfa_verified' => false
                        ]);
                        break;
                    case self::AUTHY_SMS_FAILED:
                        return response()->error('Critical Error', 500);
                        break;
                }
            } else {
                return response()->success([
                    'token' => $user->createToken(config('app.name') . ': ' . $user->username)->accessToken,
                    'mfa_verified' => false
                ]);
            }
        } else {
            return response()->error('Invalid User', 401);
        }
    }

    /**
     * Undocumented function
     *
     * @param UserLoginRequest $request
     * @return array
     */
    private function processCredentials(UserLoginRequest $request): array
    {
        $credentials = ["password" => $request->password];
        if ($request->has("email"))
            $credentials["email"] = $request->email;
        if ($request->has("username"))
            $credentials["username"] = $request->username;
        return $credentials;
    }

    /**
     * Send Authy OTP
     *
     * @param User $user
     * @return bool
     */
    private function sendOTP(User $user): bool
    {
        if ($this->notLocal() && $this->hasAuthyConfig()) {
            $authy_api = new AuthyApi(config('authy.app_secret'));
            $sms = $authy_api->requestSms($user->authy_id);
            if ($sms->ok()) {
                Log::info(json_encode($sms->message(), JSON_PRETTY_PRINT));
                return self::AUTHY_SMS_SUCCESS;
            } else {
                Log::error('glenn');
                Log::error(json_encode($sms->errors(), JSON_PRETTY_PRINT));
                return self::AUTHY_SMS_FAILED;
            }
        } else {
            return self::AUTHY_SMS_CANCELLED;
        }
    }

    private function hasMFA(User $user): bool
    {
        return (bool) ($user->authy_id && $user->phone_number);
    }

    private function notLocal(): bool
    {
        return (bool) config('app.env') !== "local";
    }

    private function hasAuthyConfig(): bool
    {
        return (bool) config('authy.app_id') && config('authy.app_secret');
    }
}
