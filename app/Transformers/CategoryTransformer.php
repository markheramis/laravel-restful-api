<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Categories;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Categories $category)
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
