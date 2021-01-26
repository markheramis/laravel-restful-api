<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

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
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
