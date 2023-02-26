<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\ApproveAuthorizationController as PassportApproveAuthorizationController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class ApproveAuthorizationController extends PassportApproveAuthorizationController
{
        /**
         * Approve Authorization
         *
         * Approve the authorization request.
         *
         * @authenticated
         * @param  Request  $request
         * @return Response
         */
        public function approve(Request $request): Response
        {
                return parent::approve($request);
        }
}
