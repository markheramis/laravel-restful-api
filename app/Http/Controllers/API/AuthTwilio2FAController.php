<?php

namespace App\Http\Controllers\API;

use Auth;
use Authy\AuthyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthTwilio2FAVerifyCodeRequest;
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
            $this->recordLoginActivity($device);
            // correct token
            return response()->success('success');
        }
    }

    private function recordLoginActivity($device)
    {
    }
}
