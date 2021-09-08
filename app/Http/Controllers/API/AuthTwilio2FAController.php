<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthTwilio2FAVerifyCodeRequest;

class AuthTwilio2FAController extends Controller
{
    public function verifyCode(AuthTwilio2FAVerifyCodeRequest $request)
    {
        return 'verify twilio';
    }
}
