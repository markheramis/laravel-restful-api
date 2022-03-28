<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('auth', function ($user) {
    return ['id' => $user->id];
});
Broadcast::channel('App.Presence.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
