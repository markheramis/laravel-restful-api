<?php

namespace App\Http\Controllers\API\Auth;

use Sentinel;
use Authy\AuthyApi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class LoginController extends Controller
{
    /**
     * Login API
     * 
     * This endpoint allows you to login users.
     *
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $response = [];
        $credentials = $this->processCredentials($request);
        # attempt to login
        if ($user = Sentinel::stateless($credentials)) {
            // If has phone number
            $response['token'] = $user->createToken(config('app.name') . ': ' . $user->username)->accessToken;
            $this->sendOTP($user);
            if ($this->sendOTP($user))
                $response['verify'] = true;
            return response()->success($response);
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
        if (config('app.env') !== "local" && $user->authy_id) {
            $authy_api = new AuthyApi(config('authy.app_secret'));
            $authy_api->requestSms($user->authy_id, [
                "action" => "login",
                "action_message" => "Login code",
            ]);
            return true;
        } else {
            return false;
        }
    }
}
