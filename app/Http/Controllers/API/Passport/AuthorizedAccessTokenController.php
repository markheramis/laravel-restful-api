<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController as PassportAuthorizedAccessTokenController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class AuthorizedAccessTokenController extends PassportAuthorizedAccessTokenController
{
        /**
         * Get Authorized Access Tokens
         *
         * Get all of the authorized tokens for the authenticated user.
         *
         * @authenticated
         * @param  Request  $request
         * @return Collection
         */
        public function forUser(Request $request): Collection
        {
                return parent::forUser($request);
        }

        /**
         * Delete Authorized Access Token
         *
         * Delete the given token.
         *
         * @authenticated
         * @param Request $request
         * @param string $tokenId
         * @return Response
         */
        public function destroy(Request $request, $tokenId): Response
        {
                return parent::destroy(
                        $request,
                        $tokenId
                );
        }
}
