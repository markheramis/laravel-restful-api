<?php

namespace App\Listeners\User\UserCreated;

use Activation;
use App\Models\User;
use App\Events\User\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedActivationEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get Activation object from the User that matches the `$event->user_id` and
     * get its latest Activation and activate it.
     *
     * @param  App\Events\User\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = User::find($event->user_id);
        $activation = $user->activations->first();
        Activation::complete($user, $activation->code);
    }

    /**
     * Queue if `$event->params` has key `activate` and its value is true.
     *
     * @param  App\Events\User\UserCreated  $event
     * @return bool
     */
    public function shouldQueue(UserCreated $event)
    {
        return array_key_exists("activate", $event->params) && $event->params['activate'];
    }
}
