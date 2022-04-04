<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionIndexRequest;

/**
 * @group Permission Management
 */
class PermissionController extends Controller
{
    /**
     * Get all Permissions
     *
     * This endpoint returns all the permissions available in the system.
     *
     * @authenticated
     * @param PermissionIndexRequest $request
     * @return void
     */
    public function index(PermissionIndexRequest $request)
    {
        $permission = config('permissions');
        return response()->success($permission);
    }
}
