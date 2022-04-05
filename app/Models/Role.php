<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole as Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, BroadcastsEvents;
    const ROLE_ADMIN = 1;
    const ROLE_DENTIST = 4;
    const ROLE_RADIOLOGIST = 5;
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PrivateChannel('role');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs($event)
    {
        return match ($event) {
            'created' => 'role.created',
            'updated' => 'role.updated',
            'deleted' => 'role.deleted',
            default => null,
        };
    }
}
