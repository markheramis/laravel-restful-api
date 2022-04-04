<?php

namespace App\Observers;

use App\Models\Activation;
use App\Mail\UserActivation;
use Illuminate\Support\Facades\Mail;
use App\Events\Activation\ActivationCreated;
use App\Events\Activation\ActivationUpdated;

class ActivationObserver
{
    /**
     * Handle the activation "created" event.
     *
     * @param  \App\Models\Activation  $activation
     * @return void
     */
    public function created(Activation $activation)
    {
        if (!config('app.env') == 'testing') {
            /**
             * Get user email of the owner of the activation.
             */
            $email = $activation->user->email;
            /**
             * send Activation link.
             */
            Mail::to($email)->queue(new UserActivation($activation));
        }

        if (config("broadcasting.default") == "pusher") {
            ActivationCreated::dispatch($activation->id);
        }
    }

    /**
     * Handle the activation "updated" event.
     *
     * @param  \App\Models\Activation  $activation
     * @return void
     */
    public function updated(Activation $activation)
    {
        if (config("broadcasting.default") == "pusher") {
            ActivationUpdated::dispatch($activation->id);
        }
    }
}
