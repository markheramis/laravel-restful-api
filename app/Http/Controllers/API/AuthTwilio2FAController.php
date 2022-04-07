<?php

namespace App\Http\Controllers\API;

use Auth;
use Authy\AuthyApi;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Twilio\AuthTwilio2FAVerifyCodeRequest;
use App\Http\Requests\Twilio\AuthTwilio2FAIsAuthenticatedRequest;
use App\Http\Requests\Twilio\AuthTwilio2FAGetQRCodeRequest;
use App\Http\Requests\Twilio\AuthTwilio2FAGetSettingsRequeust;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

/**
 * @group Auth Multi-Factor Management
 *
 * APIs for doing two factor authentication with Twilio
 */
class AuthTwilio2FAController extends Controller
{
    private $authy_app_secret;
    private $authy_app_id;


    public function __construct()
    {
        $this->authy_app_secret = config('authy.app_secret');
        $this->authy_app_id = config('authy.app_id');
    }

    /**
     * Verify OTP
     *
     * This endpoint lets you verify the OTP from Twilio
     *
     * @authenticated
     * @param AuthTwilio2FAVerifyCodeRequest $request
     * @return JsonResponse
     */
    public function verifyCode(AuthTwilio2FAVerifyCodeRequest $request): JsonResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            $authy_api = new AuthyApi(config('authy.app_secret'));
            $response = $authy_api->verifyToken($user->authy_id, $request->code);

            if ($response->ok()) {
                session()->now('mfa_verified', true);
                // correct token
                $user->tokens()->delete();
                return response()->success([
                    'message' => 'valid token',
                    'token' => $this->generateUserToken($user),
                ]);
            } else {
                return response()->error([], 'Invalid Token');
            }
        } else {
            return response()->error([], 'Invalid token');
        }
    }

    private function recordLoginActivity($device)
    {
    }

    /**
     * is Authenticated
     *
     * This endpoint lets you verify if two-factor authentication with Authy is authenticated
     *
     * @authenticated
     * @param AuthTwilio2FAIsAuthenticatedRequest $request
     * @return JsonResponse
     */
    public function isAuthenticated(AuthTwilio2FAIsAuthenticatedRequest $request): JsonResponse
    {
        $status = $request->session()->get('twilio2faVerified', "no");
        return response()->success($status);
    }

    /**
     * Get QR Code
     *
     * This endpoint lets you get an Authy QR Code.
     *
     * @authenticated
     *
     * @param AuthTwilio2FAGetQRCodeRequest $request
     * @return JsonResponse
     */
    public function getQRCode(AuthTwilio2FAGetQRCodeRequest $request): JsonResponse
    {
        $authy_api = new AuthyApi($this->authy_app_secret);
        $user = Auth::user();
        $data = $authy_api->qrCode($user->authy_id, []);
        $response = [
            'qr_code' => $data->bodyvar('qr_code'),
            'label' => $data->bodyvar('label'),
            'issuer' => $data->bodyvar('issuer'),
        ];
        if ($data->bodyvar('success')) {
            return response()->success($response);
        } else {
            return response()->error([], 'Unable to generate QR Code');
        }
    }

    /**
     * Get MFA Settings
     *
     * This endpoint lets you get mfa settings
     *
     * @param AuthTwilio2FAGetStatusRequeust $request
     * @return JsonResponse
     */
    public function getSettings(AuthTwilio2FAGetSettingsRequeust $request): JsonResponse
    {
        $data = Auth::user();
        return response()->success([
            'default_factor' => $data->default_auth_factor,
            'verified' => $data->authy_verified,
        ]);
    }

    /**
     * TODO: Enable request token via sms on login
     *
     */
    public function requestTokenSMS(Request $request)
    {
        $user = Auth::user();
        $authy_api = new AuthyApi($this->authy_app_secret);
        $requestSms = $authy_api->requestSms($user->phone_number);

        return response()->json($requestSms);
    }

    private function generateUserToken(User $user)
    {
        return $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken;
    }
}
