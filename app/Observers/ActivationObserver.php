<?php

namespace App\Observers;

use App\Models\Activation;
use App\Mail\UserActivation;
use Illuminate\Support\Facades\Mail;

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
        if(!config('app.env') == 'testing') {
            /**
            * Get user email of the owner of the activation.
            */
            $email = $activation->user->email;
            /**
             * send Activation link.
             */
            Mail::to($email)->queue(new UserActivation($activation));
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
        //
    }

    /**
     * Handle the activation "deleted" event.
     *
     * @param  \App\Models\Activation  $activation
     * @return void
     */
    public function deleted(Activation $activation)
    {
        //
    }

    /**
     * Handle the activation "restored" event.
     *
     * @param  \App\Models\Activation  $activation
     * @return void
     */
    public function restored(Activation $activation)
    {
        //
    }

    /**
     * Handle the activation "force deleted" event.
     *
     * @param  \App\Models\Activation  $activation
     * @return void
     */
    public function forceDeleted(Activation $activation)
    {
        //
    }
}
