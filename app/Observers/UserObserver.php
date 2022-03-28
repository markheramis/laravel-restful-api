<?php

namespace App\Observers;

use Activation;
use Authy\AuthyApi;
use App\Models\User;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
use App\Events\User\UserRestored;
use App\Events\User\UserDeleted;
use App\Events\User\UserForceDeleted;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        /**
         * Create and send Activation link
         */
        Activation::create($user);
        broadcast(new UserCreated($user->id));
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if (config("broadcasting.default") == "pusher") {
            broadcast(new UserUpdated($user->id));
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        if (config("broadcasting.default") == "pusher") {
            broadcast(new UserDeleted($user->id));
        }
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        if (config("broadcasting.default") == "pusher") {
            broadcast(new UserRestored($user->id));
        }
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        if (config("broadcasting.default") == "pusher") {
            broadcast(new UserForceDeleted($user->id));
        }
    }
}
