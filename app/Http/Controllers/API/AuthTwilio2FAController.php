<?php

namespace App\Http\Controllers\API;

use Auth;
use Session;
use Authy\AuthyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthTwilio2FAVerifyCodeRequest;
use App\Http\Requests\AuthTwilio2FAIsAuthenticatedRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group Multi-Factor Twilio
 * 
 * APIs for doing two factor authentication with Twilio
 */
class AuthTwilio2FAController extends Controller
{
    /**
     * Verify OTP
     * 
     * This endpoint lets you verify the OTP from Twilio
     * @authenticated
     * 
     * @param AuthTwilio2FAVerifyCodeRequest $request
     * @return JsonResponse
     */
    public function verifyCode(AuthTwilio2FAVerifyCodeRequest $request): JsonResponse
    {
        $authy_api = new AuthyApi(config('authy.app_secret'));
        $authy_id = Auth::user()->authy_id;
        $code = $request->code;
        $response = $authy_api->verifyToken($authy_id, $code);
        if ($response->ok()) {
            // record login activity
            $device = $response->bodyvar('device');
            $request->session()->put('twilio2faVerified', "yes");
            $this->recordLoginActivity($device);
            // correct token
            return response()->success('valid token');
        } else {
            $request->session()->put('twilio2faVerified', "no");
            return response()->error('invalid token');
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
}
