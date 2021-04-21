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
     * @param string $slug the slug of the User we want to get the Role from
     * @return JsonResponse
     */
    public function show(UserRoleShowRequest $request, User $user): JsonResponse
    {
        /* $user = User::where('id', $id)->first(); */
        if ($user) {
            $roles = $user->roles;
            $response = fractal($roles, new RoleTransformer())->toArray();
            return response()->success($response);
        } else
            return response()->error('Not Found', 404);
    }

    /**
     * Add Role to User
     * 
     * This endpoint lets you add a Role to a User.
     *
     * @authenticated
     * @todo 2nd paramter should auto resolve into a User model instance.
     * @param UserRoleAddRequest $request
     * @param string $slug the slug of the User that we want to add the Role into.
     * @return JsonResponse
     */
    public function add(UserRoleAddRequest $request, string $slug): JsonResponse
    {
        $user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $request->slug)->first();
        if ($user && $role) {
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
     * @param string $slug the slug of the User where we want the Role removed from.
     * @return JsonResponse
     */
    public function delete(UserRoleDeleteRequest $request, string $slug): JsonResponse
    {
        $user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $slug)->first();
        if ($user && $role) {
            $role->users()->detach($user);
            return response()->success('Detached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }
}
