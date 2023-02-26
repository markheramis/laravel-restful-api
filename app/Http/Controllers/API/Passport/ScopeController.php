<?php

namespace App\Http\Controllers\API\Passport;

use Laravel\Passport\Http\Controllers\ScopeController as PassportScopeController;
use Illuminate\Support\Collection;

/**
 * @group Passport
 *
 * APIs from Passport
 */
class ScopeController extends PassportScopeController
{
        /**
         * Get Personal Access Token Scopes
         *
         * Get all of the available scopes for the application.
         *
         * @authenticated
         * @return Collection
         */
        public function all(): Collection
        {
                return parent::all();
        }
}
