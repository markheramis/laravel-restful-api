<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\TransientTokenController as PassportTransientTokenController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class TransientTokenController extends PassportTransientTokenController
{
        /**
         * Get Fresh Transient Token
         *
         * Get a fresh transient token cookie for the authenticated user.
         *
         * @authenticated
         * @param  Request  $request
         * @return Response
         */
        public function refresh(Request $request): Response
        {
                return parent::refresh($request);
        }
}
