<?php

namespace App\Models;

use App\Models\User;
use App\Models\Worklist;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, BroadcastsEvents;

    protected $table = 'medias';
    protected $fillable = [
        "user_id",
        "path",
        "url",
        "type",
        "description",
        "meta",
        "status",
    ];

    protected $guarded = [];

    protected $casts = [
        'meta' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PrivateChannel('media');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs($event)
    {
        return match ($event) {
            'created' => 'media.created',
            'updated' => 'media.updated',
            'deleted' => 'media.deleted',
            default => null,
        };
    }
}
