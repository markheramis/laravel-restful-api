<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\Role;

class RoleTransformer extends TransformerAbstract
{
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
            'permissions' => $role->permissions,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
