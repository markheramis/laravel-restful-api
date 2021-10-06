<?php

namespace App\Http\Controllers\API;

use Auth;
use Sentinel;
use Authy\AuthyApi;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthTwilio2FAVerifyCodeRequest;
use App\Http\Requests\AuthTwilio2FAIsAuthenticatedRequest;
use App\Http\Requests\AuthTwilio2FAGetQRCodeRequest;
use App\Http\Requests\AuthTwilio2FAGetSettingsRequeust;
use Illuminate\Http\JsonResponse;

/**
 * @group Auth Multi-Factor Management
 * 
 * APIs for doing two factor authentication with Twilio
 */
class AuthTwilio2FAController extends Controller
{
    /**
     * Verify OTP
     * 
     * This endpoint lets you verify the OTP from Twilio
     * 
     * @param AuthTwilio2FAVerifyCodeRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function verifyCode(AuthTwilio2FAVerifyCodeRequest $request): JsonResponse
    {
        $user = Sentinel::stateless($request->only('username', 'password'));
        $authy_api = new AuthyApi(config('authy.app_secret'));
        $response = $authy_api->verifyToken($user->authy_id, $request->code);
        if ($response->ok()) {
            session()->now('mfa_verified', true);
            // correct token
            return response()->success([
                'message' => 'valid token',
                'token' => $user->createToken(config('app.name') . ': ' . $user->username)->accessToken,
                'mfa_verified' => true
            ]);
        } else {
            /* $request->session()->put('twilio2faVerified', "no"); */
            return response()->error(['message' => 'invalid token']);
        }
        return response()->error(['message' => 'invalid token']);
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
        $authy_api = new AuthyApi(config('authy.app_secret'));
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
            return response()->error('Unable to generate QR Code');
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
}
