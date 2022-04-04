<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;

class Option extends Model
{
    use HasFactory, BroadcastsEvents;

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function getRouteKeyName()
    {
        return 'name';
    }
    
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PrivateChannel('option');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs($event)
    {
        return match ($event) {
            'created' => 'option.created',
            'updated' => 'option.updated',
            'deleted' => 'option.deleted',
            default => null,
        };
    }
}
