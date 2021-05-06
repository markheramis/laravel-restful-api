<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use App\Http\Requests\UserRoleAddRequest;
use App\Http\Requests\UserRoleShowRequest;
use App\Http\Requests\UserRoleDeleteRequest;
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
     * @todo 2nd paramter should auto resolve into a User model instance.
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
     * @todo 2nd paramter should auto resolve into a User model instance.
     * @param UserRoleAddRequest $request
     * @param App\Models\User $user auto reolved instance of User
     * @return JsonResponse
     */
    public function add(UserRoleAddRequest $request, User $user): JsonResponse
    {
        if ($role = Role::where('slug', $request->slug)->first()) {
            $role->users()->attach($user);
            return response()->success('Attached Successfully');
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
     * @todo 2nd parameter should auto resolve to a User model instance.
     * @param UserRoleDeleteRequest $request
     * @param App\Models\User $user auto reolved instance of User
     * @return JsonResponse
     */
    public function delete(UserRoleDeleteRequest $request, User $user): JsonResponse
    {
        if ($role = Role::where('slug', $request->slug)->first()) {
            $role->users()->detach($user);
            return response()->success('Detached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }
}
