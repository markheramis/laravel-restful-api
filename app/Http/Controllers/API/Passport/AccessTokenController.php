<?php

namespace App\Http\Controllers\API\Passport;


use Laravel\Passport\Http\Controllers\AccessTokenController as PassportAccessTokenController;
use Illuminate\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class AccessTokenController extends PassportAccessTokenController
{
        /**
         * Issue Access Token
         *
         * Authorize a client to access the user's account.
         *
         * @bodyParam grant_type string required the passport grant type.
         * @bodyParam client_id int required the passport client id.
         * @bodyParam client_secret string required the passport client secret.
         * @bodyParam username string required the passport client username.
         * @bodyParam password string required the passport client password.
         * @bodyParam scope array the token scope.
         *
         * @param  ServerRequestInterface  $request
         * @return Response
         */
        public function issueToken(ServerRequestInterface $request): Response
        {
                return parent::issueToken($request);
        }
}
