<?php

namespace App\Listeners\User\UserCreated;

use App\Models\User;

use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreatedAdminNotificationEventListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        \Log::info("UserCreatedAdminNotificationEventListener");
        $user = User::find($event->user_id);
    }
}
