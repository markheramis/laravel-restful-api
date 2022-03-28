<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Media;


class MediaTransformer extends TransformerAbstract
{

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
            'url' => $media->url,
            'desscription' => $media->description,
            'meta' => $media->meta,
            'status' => $media->status,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
    }
}
