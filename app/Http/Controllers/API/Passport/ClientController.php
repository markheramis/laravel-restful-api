<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\ClientController as PassportClientController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Passport\Client;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class ClientController extends PassportClientController
{
        /**
         * Get Clients
         *
         * Get all of the clients for the authenticated user.
         *
         * @authenticated
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Database\Eloquent\Collection
         */
        public function forUser(Request $request): Collection
        {
                return parent::forUser($request);
        }

        /**
         * Store Clients
         *
         * Store a new client.
         *
         * @authenticated
         * @param  \Illuminate\Http\Request  $request
         * @return \Laravel\Passport\Client|array
         */
        public function store(Request $request): Client | array
        {
                return parent::store($request);
        }

        /**
         * Update Clients
         *
         * Update the given client.
         *
         * @authenticated
         * @param Request $request
         * @param string $clientId
         * @return \Illuminate\Http\Response|\Laravel\Passport\Client
         */
        public function update(Request $request, $clientId): Response | Client
        {
                return parent::update($request, $clientId);
        }

        /**
         * Delete Clients
         *
         * Delete the given client.
         *
         * @authenticated
         * @param Request $request
         * @param string $clientId
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request, $clientId): Response
        {
                return parent::destroy($request, $clientId);
        }
}
