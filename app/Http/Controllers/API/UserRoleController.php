<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use App\Http\Requests\UserRoleStoreRequest;
use App\Http\Requests\UserRoleShowRequest;
use App\Http\Requests\UserRoleDestroyRequest;
use App\Http\Requests\UserRoleUpdateRequest;
use Illuminate\Http\JsonResponse;

/**
 * @group User Role Management
 * 
 * APIs for managing a User's Role
 */
class UserRoleController extends Controller
{

    /**
     * Get User Roles
     * 
     * This endpoint lets you get a User's Roles
     *
     * @authenticated
     * @param UserRoleGetRequest $request
     * @param App\Models\User $user auto reolved instance of User
     * @return JsonResponse
     */
    public function show(UserRoleShowRequest $request, User $user): JsonResponse
    {
        $roles = $user->roles;
        $response = fractal($roles, new RoleTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Add Role to User
     * 
     * This endpoint lets you add a Role to a User.
     *
     * @authenticated
     * @param UserRoleStoreRequest $request
     * @param App\Models\User $user auto reolved instance of User
     * @return JsonResponse
     */
    public function store(UserRoleStoreRequest $request, User $user): JsonResponse
    {
        if ($role = Role::where('slug', $request->slug)->first()) {
            $role->users()->attach($user);
            return response()->success('Attached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }

    /**
     * Update Role to User
     * 
     * The endpoint lets you update a Role to a User
     *
     * @authenticated
     * @param UserRoleUpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRoleUpdateRequest $request, User $user): JsonResponse
    {
        $role = Role::where('slug', $request->slug)->first();
        if ($role) {
            $user->roles()->sync($role->id);
            return response()->success('User role Updated');
        } else {
            return response()->error('Not Found', 404);
        }
    }

    /**
     * Delete a User's Role
     * 
     * This endpoint lets you delete a User's Role
     *
     * @authenticated
     * @param UserRoleDestroyRequest $request
     * @param App\Models\User $user auto reolved instance of User
     * @return JsonResponse
     */
    public function destroy(UserRoleDestroyRequest $request, User $user): JsonResponse
    {
        if ($role = Role::where('slug', $request->slug)->first()) {
            $role->users()->detach($user);
            return response()->success('Detached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }
}
