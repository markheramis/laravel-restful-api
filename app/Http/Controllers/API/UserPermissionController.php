<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Transformers\PermissionTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPermissionShowRequest;
use App\Http\Requests\UserPermissionAddRequest;
use App\Http\Requests\UserPermissionUpdateRequest;
use App\Http\Requests\UserPermissionDeleteRequest;
use \Illuminate\Http\JsonResponse;

/**
 * @group User Permission Management
 * 
 * APIs for managing a User's Permissions
 */
class UserPermissionController extends Controller
{

    /**
     * Get User Permission
     * 
     * This endpoint lets you get a User's Permissions
     *
     * @authenticated
     * @todo 2nd parameter should auto resolve into a User model instance
     * @param UserPermissionGetRequest $request
     * @param App\Models\User $$user auto resolved User eloquent instance.
     * @return JsonResponse
     */
    public function show(UserPermissionShowRequest $request, User $user): JsonResponse
    {
        $permission = $user->permissions;
        $response = fractal($permission, new PermissionTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Add User Permission
     *
     * This endpoint lets you add a Permission to a User
     * 
     * @authenticated
     * @todo 2nd parameter should autoresolve into a User model instance
     * @param UserPermissionAddRequest $request
     * @param App\Models\User $$user auto resolved User eloquent instance.
     * @return JsonResponse
     */
    public function add(UserPermissionAddRequest $request, User $user): JsonResponse
    {
        $user->addPermission($request->slug, $request->value);
        if ($user->save()) {
            return response()->success('Permission added successfully');
        } else {
            return response()->error('Failed to add permission', 400);
        }
    }

    /**
     * Update User Permission
     *
     * This endpoint lets you update a Permission from a User
     * 
     * @authenticated
     * @todo 2nd parameter should auto resolve into a User model instance
     * @param UserPermissionUpdateRequest $request
     * @param App\Models\User $$user auto resolved User eloquent instance.
     * @return JsonResponse
     */
    public function update(UserPermissionUpdateRequest $request, User $user): JsonResponse
    {
        $user->updatePermission($request->slug, $request->value, true);
        if ($user->save()) {
            return response()->success('Permission updated successfully');
        } else {
            return response()->error('Failed to update permission', 400);
        }
    }

    /**
     * Delete User Permission
     * 
     * This endpoint lets you delete a Permission from a User
     *
     * @authenticated
     * @todo 2nd parameter should auto resolve into a User model instance
     * @param UserPermissionDeleteRequest $request
     * @param App\Models\User $$user auto resolved User eloquent instance.
     * @return JsonResponse
     */
    public function delete(UserPermissionDeleteRequest $request, User $user): JsonResponse
    {
        $user->removePermission($request->slug);
        if ($user->save()) {
            return response()->success('Permission deleted successfully');
        } else {
            return response()->error('Failed to delete permission', 400);
        }
    }
}
