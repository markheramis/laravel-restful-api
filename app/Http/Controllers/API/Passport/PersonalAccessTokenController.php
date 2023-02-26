<?php

namespace App\Http\Controllers\API\Passport;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;

use Laravel\Passport\TokenRepository;
use Laravel\Passport\PersonalAccessTokenResult;
use App\Http\Requests\OAuth\PersonalAccessTokenIndexRequest;
use App\Http\Requests\OAuth\PersonalAccessTokenStoreRequest;

use App\Models\User;
/**
 * @group Passport
 *
 * APIs from Passport
 */
class PersonalAccessTokenController
{
        /**
         * The token repository implementation.
         *
         * @var \Laravel\Passport\TokenRepository
         */
        protected $tokenRepository;

        /**
         * The validation factory implementation.
         *
         * @var \Illuminate\Contracts\Validation\Factory
         */
        protected $validation;

        /**
         * Create a controller instance.
         *
         * @param  TokenRepository  $tokenRepository
         * @param  ValidationFactory  $validation
         * @return void
         */
        public function __construct(TokenRepository $tokenRepository, ValidationFactory $validation)
        {
                $this->validation = $validation;
                $this->tokenRepository = $tokenRepository;
        }

        /**
         * Get Personal Access Tokens
         *
         * Get all of the personal access tokens for the authenticated user.
         *
         * @authenticated
         * @param  PersonalAccessTokenIndexRequest  $request
         * @return Collection
         */
        public function index(
                PersonalAccessTokenIndexRequest $request
        ): Collection {
                $tokens = $this
                        ->tokenRepository
                        ->forUser(
                                Auth::user()->getAuthIdentifier()
                        );

                $result = $tokens->load('client')->filter(function ($token) {
                        return $token->client->personal_access_client && !$token->revoked;
                })->values();
                return response()->success($result);
        }

        /**
         * Create Personal Access Token
         *
         * Create a new personal access token for the user.
         *
         * @authenticated
         * @param  Request  $request
         * @return PersonalAccessTokenResult
         */
        public function store(
                PersonalAccessTokenStoreRequest $request
        ): PersonalAccessTokenResult {
                /**
                 * @var User
                 */
                $user = Auth::user();
                $token = $user->createToken(
                        $request->name,
                        $request->scopes ?: []
                );
                return response()->success($token);
        }

        /**
         * Delete Personal Access Token
         *
         * Delete the given token.
         *
         * @authenticated
         * @param  Request  $request
         * @param  string  $tokenId
         * @return Response
         */
        public function destroy(Request $request, $tokenId): Response
        {
                $token = $this->tokenRepository->findForUser(
                        $tokenId,
                        Auth::user()->getAuthIdentifier()
                );
                if (is_null($token)) {
                        return new Response('', 404);
                }
                $token->revoke();
                return new Response('', Response::HTTP_NO_CONTENT);
        }
}
