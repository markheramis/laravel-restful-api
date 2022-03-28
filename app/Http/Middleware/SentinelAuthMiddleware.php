<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class SentinelAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!($token = $request->bearerToken())) {
            throw new AuthenticationException;
        }

        $user = auth('api')->user();
        if ($user) {
            // $request->merge(['user' => $user ]);
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
        }
        return $next($request);
    }
}
