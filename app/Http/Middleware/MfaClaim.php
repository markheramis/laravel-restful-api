<?php

namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Configuration;
use Illuminate\Auth\AuthenticationException;

class MfaClaim
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $claim
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        /* check for presence of token */
        if ( ! ($token = $request->bearerToken())) {
            throw new AuthenticationException;
        }

        /* check if token parses properly */
        try {
            $jwt = (Configuration::forUnsecuredSigner()->parser()->parse($token));
        } catch(\Exception $e) {
            throw new AuthenticationException;
        }

        if (notLocal() && hasAuthyConfig() && auth()->user()->hasMFA()) {
            if ($jwt->claims()->has('mfa_verified') && $jwt->claims()->get('mfa_verified') == false) {
                return $next($request);
            }
            throw new AuthenticationException('Unauthenticated: MFA not verified.');
        }
        return $next($request);
    }
}
