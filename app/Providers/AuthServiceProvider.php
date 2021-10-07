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
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::tokensCan([
            "user.index" => "User index",
            "user.show" => "User show",
            "user.store" => "User store",
            "user.update" => "User update",
            "user.destroy" => "User destroy",

            "role.index" => "Role index",
            "role.show" => "Role show",
            "role.store" => "Role store",
            "role.update" => "Role update",
            "role.destroy" => "Role destroy",

            "user.role.show" => "User Role show",
            "user.role.store" => "User Role store",
            "user.role.update" => "User Role update",
            "user.role.destroy" => "User Role destroy",

            "user.permission.store" => "User permission store",
            "user.permission.show" => "User permission show",
            "user.permission.destroy" => "User permission destroy",

            "category.index" => "Category index",
            "category.store" => "Category store",
            "category.show" => "Category show",
            "category.update" => "Category update",
            "category.destroy" => "Category destroy",

            "option.index" => "Option index",
            "option.store" => "Option store",
            "option.show" => "Option show",
            "option.update" => "Option update",
            "option.destroy" => "Option destroy",
        ]);
    }
}
