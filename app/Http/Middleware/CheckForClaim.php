<?php
/**
 * Delete this middleware once the package's middleware will work correctly and
 * replace the CheckForClaim middleware in App\Http\Kernel.php file with the
 * original CheckForClaim class.
 */
namespace App\Http\Middleware;

use Closure;
use Lcobucci\JWT\Configuration;
use Illuminate\Auth\AuthenticationException;

class CheckForClaim
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
    public function handle($request, Closure $next, $claim, $value = null)
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

        if ($jwt->claims()->has($claim)) {
            if ($value == null) {
                return $next($request);
            }

            $value = $this->convertStringBooleans($value);
            if ($jwt->claims()->get($claim) == $value) {
                return $next($request);
            }
        }

        throw new AuthenticationException('Unauthenticated: missing claim');
    }

    /**
     * Converts all string booleans to booleans
     *
     * @param   array  $data
     * @return  array
     */
    private function convertStringBooleans($value)
    {
        $newValvue = false;
        if ($value === 'true' || $value === 'TRUE') {
            $newValvue = true;
        }

        if ($value === 'false' || $value === 'FALSE') {
            $newValvue = false;
        }

        return $newValvue;
    }
}
