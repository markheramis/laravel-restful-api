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
        if (!($token = $request->bearerToken()))
            return response('No Token', 401);
        /* check if token parses properly */
        try {
            $jwt = (Configuration::forUnsecuredSigner()->parser()->parse($token));
            if (notLocal() && hasAuthyConfig() && auth()->user()->hasMFA()) {
                if ($jwt->claims()->has('mfa_verified')) :
                    if ($jwt->claims()->get('mfa_verified') == true)
                        return $next($request);
                    else
                        return response('Unauthorized: MFA not verified.', 403);
                else :
                    return response('Unauthorized: No MFA claim', 403);
                endif;
            }
        } catch (\Exception $e) {
            return response($e->getMessage(), 500);
        }
        return $next($request);
    }
}
