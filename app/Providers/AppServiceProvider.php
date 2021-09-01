<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Option;
use App\Models\Media;
use App\Models\Permission;
use App\Models\Throttle;
use App\Models\Activation;

use App\Observers\UserObserver;
use App\Observers\RoleObserver;
use App\Observers\CategoryObserver;
use App\Observers\OptionObserver;
use App\Observers\MediaObserver;
use App\Observers\PermissionObserver;
use App\Observers\ThrottleObserver;
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
        Role::observe(RoleObserver::class);
        Category::observe(CategoryObserver::class);
        Option::observe(OptionObserver::class);
        Media::observe(MediaObserver::class);
        Permission::observe(PermissionObserver::class);
        Throttle::observe(ThrottleObserver::class);
        Activation::observe(ActivationObserver::class);
    }
}
