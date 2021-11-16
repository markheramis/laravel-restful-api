<?php

namespace App\Listeners\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserLoggedInNotification;

class UserLoggedInListener
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
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
            $query->where('roles.id', Role::ROLE_ADMIN);
        })->get();
        Notification::send($admins, new UserLoggedInNotification($event->user));

        activity()->event('logged_in')->causedBy($event->user)->log('User:login');
    }
}
