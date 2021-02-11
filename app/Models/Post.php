<?php

namespace App\Models;

#use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasSlug;

    protected $fillable = [
        'status',
        'title',
        'abstractContent',
        'fullContent',
        'sourceURL',
        'imageURL',
        'platforms',
        'disableComment',
        'importance',
        'author',
        'reviewer',
        'type',
        'pageviews',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('username')
            ->saveSlugsTo('slug');
    }
}
