<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthTwilio2FAVerifyCodeRequest;

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
     * @param AuthTwilio2FAVerifyCodeRequest $request
     * @return void
     */
    public function verifyCode(AuthTwilio2FAVerifyCodeRequest $request)
    {
        return 'verify twilio';
    }
}
