<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthTwilio2FAController extends Controller
{
    public function verifyCode(Request $request)
    {
        return 'verify twilio';
    }
}
