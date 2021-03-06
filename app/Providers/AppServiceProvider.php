<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Activation;
use App\Observers\UserObserver;
use App\Observers\ActivationObserver;

class AppServiceProvider extends ServiceProvider
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
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(200); // Default String Length on Database
        $this->registerPolicies();

        /**
         * Add passport routes
         */
        Passport::routes();

        /**
         * Register Observers
         */
        User::observe(UserObserver::class);
        Activation::observe(ActivationObserver::class);
    }
}
