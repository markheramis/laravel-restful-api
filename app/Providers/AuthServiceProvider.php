<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        #'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Passport::routes();
        Passport::routes(null, ['middleware' => [
            'auth:api'
        ]]);
        # Expiry Configuration
        Passport::tokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        Passport::refreshTokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        Passport::personalAccessTokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        # End  Expiry Configuration
        Passport::enableImplicitGrant();
        Passport::tokensCan(config('permissions'));
    }
}
