<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\DenyAuthorizationController as PassportDenyAuthorizationController;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class DenyAuthorizationController extends PassportDenyAuthorizationController
{
        /**
         * Deny Authorization
         *
         * Deny the authorization request.
         *
         * @authenticated
         * @param Request $request
         * @return \Illuminate\Http\RedirectResponse
         */
        public function deny(Request $request): RedirectResponse
        {
                return parent::deny($request);
        }
}
