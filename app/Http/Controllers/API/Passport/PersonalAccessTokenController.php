<?php

namespace App\Http\Controllers\API\Passport;

use Auth;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Passport\TokenRepository;

use App\Http\Requests\OAuth\PersonalAccessTokenIndexRequest;
use App\Http\Requests\OAuth\PersonalAccessTokenStoreRequest;

/**
 * @group Personal Access Token Management
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
     * @param  \Laravel\Passport\TokenRepository  $tokenRepository
     * @param  \Illuminate\Contracts\Validation\Factory  $validation
     * @return void
     */
    public function __construct(TokenRepository $tokenRepository, ValidationFactory $validation)
    {
        $this->validation = $validation;
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * Get Personal Access Token
     *
     * Get all of the personal access tokens for the authenticated user.
     *
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(PersonalAccessTokenIndexRequest $request)
    {
        $tokens = $this->tokenRepository->forUser(Auth::user()->getAuthIdentifier());
        $result =  $tokens->load('client')->filter(function ($token) {
            return $token->client->personal_access_client && !$token->revoked;
        })->values();
        return response()->success($result);
    }

    /**
     * Store Personal Access Token
     *
     * Create a new personal access token for the user.
     *
     * @authenticated
     * @param PersonalAccessTokenStoreRequest  $request
     * @return \Laravel\Passport\PersonalAccessTokenResult
     */
    public function store(PersonalAccessTokenStoreRequest $request)
    {
        $result = Auth::user()->createToken($request->name, $request->scopes ?: []);
        return response()->success($result);
    }

    /**
     * Revoke Perosnal Access Token
     *
     * Delete the given token.
     *
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $tokenId
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $tokenId)
    {
        $token = $this->tokenRepository->findForUser($tokenId, Auth::user()->getAuthIdentifier());
        if (is_null($token))
            return new Response('', 404);
        $token->revoke();
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
