<?php

namespace App\Observers;

use App\Models\Throttle;

class ThrottleObserver
{
    /**
     * Handle the Throttle "created" event.
     *
     * @param  \App\Models\Throttle  $throttle
     * @return void
     */
    public function created(Throttle $throttle)
    {
        //
    }

    /**
     * Handle the Throttle "updated" event.
     *
     * @param  \App\Models\Throttle  $throttle
     * @return void
     */
    public function updated(Throttle $throttle)
    {
        //
    }

    /**
     * Handle the Throttle "deleted" event.
     *
     * @param  \App\Models\Throttle  $throttle
     * @return void
     */
    public function deleted(Throttle $throttle)
    {
        //
    }

    /**
     * Handle the Throttle "restored" event.
     *
     * @param  \App\Models\Throttle  $throttle
     * @return void
     */
    public function restored(Throttle $throttle)
    {
        //
    }

    /**
     * Handle the Throttle "force deleted" event.
     *
     * @param  \App\Models\Throttle  $throttle
     * @return void
     */
    public function forceDeleted(Throttle $throttle)
    {
        //
    }
}
