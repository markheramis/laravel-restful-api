<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Role;

class RoleTransformer extends TransformerAbstract
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
    public function transform(Role $role)
    {
        $created_at = Carbon::parse($role->created_at)->toFormattedDateString();
        $updated_at = Carbon::parse($role->updated_at)->toFormattedDateString();
        return [
            'id' => $role->id,
            'slug' => $role->slug,
            'name' => $role->name,
            'permissions' => $role->permission,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
