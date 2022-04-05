<?php

namespace App\Providers;

use App\Events\User\UserCreated;
use App\Events\User\UserLoggedIn;
use App\Events\User\UserLoggedOut;
use Illuminate\Auth\Events\Registered;
use App\Listeners\User\UserLoggedInListener;
use App\Listeners\User\UserLoggedOutListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Listeners\User\UserCreated\UserCreatedAdminNotificationEventListener;
use App\Listeners\User\UserCreated\UserCreatedActivationEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'Laravel\Passport\Events\AccessTokenCreated' => [
            'App\Listeners\RevokeOldTokens',
        ],
        'Laravel\Passport\Events\RefreshTokenCreated' => [
            'App\Listeners\PruneOldTokens',
        ],
        UserCreated::class => [
            UserCreatedAdminNotificationEventListener::class,
            UserCreatedActivationEventListener::class,
        ],
        UserLoggedIn::class => [
            UserLoggedInListener::class
        ],
        UserLoggedOut::class => [
            UserLoggedOutListener::class
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
