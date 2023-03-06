<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Passport\AuthCode;
use App\Models\Passport\Client;
use App\Models\Passport\PersonalAccessClient;
use App\Models\Passport\RefreshToken;
use App\Models\Passport\Token;

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
        # Custom Passport Models
        Passport::useTokenModel(Token::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        # Expiry Configuration
        Passport::tokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        Passport::refreshTokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        Passport::personalAccessTokensExpireIn(now()->addHours(config('passport.token_expire_in')));
        # End  Expiry Configuration
        Passport::enableImplicitGrant();
        Passport::tokensCan(config('permissions'));
    }
}
