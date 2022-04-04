<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasSlug, BroadcastsEvents;

    protected $fillable = [
        'parent_id',
        'name',
    ];

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
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }



    public function parent()
    {
        return $this->belongsTo(Categories::class);
    }

    public function child()
    {
        return $this->hasMany(Categories::class);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn($event)
    {
        return new PrivateChannel('category');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs($event)
    {
        return match ($event) {
            'created' => 'category.created',
            'updated' => 'category.updated',
            'deleted' => 'category.deleted',
            default => null,
        };
    }
}
