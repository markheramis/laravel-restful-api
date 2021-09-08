<?php

namespace App\Http\Controllers\API;

use Auth;
use Google2FA;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthGoogle2FAGetQRCodeRequest;
use App\Http\Requests\AuthGoogle2FAVerifyCodeRequest;

/**
 * @group Google Two Factor Authentication
 * 
 * APIs for doing two factor authentication with Google
 */
class AuthGoogle2FAController extends Controller
{
    /**
     * Get QR Code
     *
     * This endpoint lets you get a QR code for a user.
     *
     * @authenticated
     * @param AuthGoogle2FAGetQRCodeRequest $request
     * @param User $user
     * @return void
     */
    public function getQRCode(AuthGoogle2FAGetQRCodeRequest $request, User $user)
    {
        return Google2FA::getQRCodeInline(
            $user->username,
            $user->email,
            $user->google2fa_secret
        );
    }
    /**
     * Verify Multi-Factor Authentication Code for Google
     *
     * This endpoint lets you verify the OTP from Google
     *
     * @param AuthGoogle2FAVerifyCodeRequest $request
     * @param User $user
     * @return void
     */
    public function verifyCode(AuthGoogle2FAVerifyCodeRequest $request)
    {
        $user = Auth::user();
        // Get all 2FAs
        $google2fas = $user->google2fa;
        // Loop through all
        foreach ($google2fas as $g2fa) {
            // Check if one of them is valid
            $result = Google2FA::verifyKey($g2fa->secret_key, $request->code);
            if ($result) {
                return $result;
            }
        }
    }
}
