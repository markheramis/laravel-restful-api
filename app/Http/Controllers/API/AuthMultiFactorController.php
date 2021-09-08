<?php

namespace App\Http\Controllers\API;

use Google2FA;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AuthMultiFactoryGetQRCodeRequest;
use App\Http\Requests\AuthMultiFactorVerifyCodeRequest;
use Illuminate\Support\Facades\Auth;

/**
 * @group Multi Factor Management
 *
 * APIs for managing Multi-Factor Authentication
 */
class AuthMultiFactorController extends Controller
{
    /**
     * Get QR Code
     *
     * This endpoint lets you get a QR code for a user.
     *
     * @authenticated
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function getQRCode(AuthMultiFactoryGetQRCodeRequest $request, User $user)
    {
        return Google2FA::getQRCodeInline(
            $user->username,
            $user->email,
            $user->google2fa_secret
        );
    }

    /**
     * Verify Multi-Factor Authentication Code
     *
     * This endpoint lets you verify the Multi-Factor Authentication Code.
     *
     * @param AuthMultiFactorVerifyCodeRequest $request
     * @param User $user
     * @return void
     */
    public function verifyCode(AuthMultiFactorVerifyCodeRequest $request)
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
