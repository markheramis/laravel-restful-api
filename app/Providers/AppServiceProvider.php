<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Media;
use App\Models\Throttle;
use App\Models\Activation;
use App\Observers\UserObserver;
use App\Observers\RoleObserver;
use App\Observers\CategoryObserver;
use App\Observers\MediaObserver;
use App\Observers\ThrottleObserver;
use App\Observers\ActivationObserver;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

class AppServiceProvider extends ServiceProvider {

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
    public function register() {
        $this->registerTelescope();
        $this->registerUser();
        $this->registerActivation();
    }

    protected function registerTelescope() {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    protected function registerRole() {
        $this->app->singleton('roles', function($app) {
            return new RoleRepository();
        });
    }

    protected function registerUser() {
        $this->registerHasher();
        $this->app->singleton('users', function ($app) {
            return new UserRepository(
                $app['hasher'],
                $app['events']
            );
        });
    }

    protected function registerHasher() {
        $this->app->singleton('hasher', function () {
            return new \App\Hashers\BcryptHasher();
        });
    }

    protected function registerActivation() {

        $this->app->singleton('activations', function ($app) {
            return new IlluminateActivationRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Passport::hashClientSecrets();
        if (config('app.env') !== 'local') {
            \URL::forceScheme('https');
        }
        Schema::defaultStringLength(200); // Default String Length on Database
        /**
         * Register Observers
         */
        User::observe(UserObserver::class);
        Role::observe(RoleObserver::class);
        Category::observe(CategoryObserver::class);
        Media::observe(MediaObserver::class);
        Throttle::observe(ThrottleObserver::class);
        Activation::observe(ActivationObserver::class);
    }

    /**
     * {@inheritDoc}
     */
    public function provides() {
        return [
            'users',
            'hasher',
        ];
    }

}
