<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AuthMultiFactoryGetQRCodeRequest;
use App\Http\Requests\AuthMultiFactorVerifyCodeRequest;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FAQRCode\Google2FA;

/**
 * @group Multi Factor Management
 *
 * APIs for managing Multi-Factor Authentication
 */
class AuthGoogle2FAController extends Controller
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
        $google2fa = new Google2FA;

        if ($user->google2fa) {
            $google2faUrl = $google2fa->getQRCodeUrl(
                $user->username,
                $user->email,
                $user->google2fa->secret_key
            );
            $writer = new Writer(
                new ImageRenderer(new RendererStyle(400), new ImagickImageBackEnd())
            );
            $qrcode_image = base64_encode($writer->writeString($google2faUrl));
            return $qrcode_image;
        }
        return response()->error([],'MFA Not enabled');
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
        $google2fas = $user->google2fa->secret_key;
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
