<?php

namespace App\Claims;

use CorBosman\Passport\AccessToken;

class MfaVerifiedClaim
{
    public function handle(AccessToken $token, $next)
    {
        $mfaVerified = false;
        if (session('mfa_verified') === true) {
            $mfaVerified = true;
        }
        $token->addClaim('mfa_verified', $mfaVerified);
        return $next($token);
    }
}
