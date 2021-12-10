<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Media;


class MediaTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Media $media)
    {
        $created_at = Carbon::parse($media->created_at)->toFormattedDateString();
        $updated_at = Carbon::parse($media->updated_at)->toFormattedDateString();
        return [
            'id' => $media->id,
            'user' => $media->user_id,
            'path' => $media->path,
            'desscription' => $media->description,
            'status' => $media->status,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
    }
}
