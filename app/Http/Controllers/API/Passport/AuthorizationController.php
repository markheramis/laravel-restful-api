<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\AuthorizationController as PassportAuthorizationController;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\TokenRepository;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class AuthorizationController extends PassportAuthorizationController
{
        /**
         * Authorize
         *
         * Authorize a client to access the user's account.
         *
         * @authenticated
         * @param ServerRequestInterface $psrRequest
         * @param Request $request
         * @param ClientRepository $clients
         * @param TokenRepository $tokens
         * @return void
         */
        public function authorize(
                ServerRequestInterface $psrRequest,
                Request $request,
                ClientRepository $clients,
                TokenRepository $tokens
        ): Response {
                return parent::authorize($psrRequest, $request, $clients, $tokens);
        }
}
