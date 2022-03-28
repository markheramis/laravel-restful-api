<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
{


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        $created_at = Carbon::parse($category->created_at)->toFormattedDateString();
        $updated_at = Carbon::parse($category->updated_at)->toFormattedDateString();
        return [
            'id' => (int) $category->id,
            'parent_id' => (int) $category->parent_id,
            'name' => $category->name,
            'slug' => $category->slug,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
    }
}
