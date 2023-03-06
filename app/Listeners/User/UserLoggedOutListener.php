<?php

namespace App\Listeners\User;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserLoggedOutNotification;

class UserLoggedOutListener
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
        \Log::info("UserLoggedOutListener:handle");
        $admins = User::whereHas('roles', function ($query) {
            $query->where('roles.id', 1);
        })->get();
        Notification::send($admins, new UserLoggedOutNotification($event->user));
        activity()->event('logged_out')->causedBy($event->user)->log('User:logout');
    }
}
