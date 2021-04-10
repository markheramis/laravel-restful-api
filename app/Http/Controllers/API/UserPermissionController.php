<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use App\Transformers\PermissionTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPermissionGetRequest;
use App\Http\Requests\UserPermissionAddRequest;
use App\Http\Requests\UserPermissionUpdateRequest;
use App\Http\Requests\UserPermissionDeleteRequest;
use \Illuminate\Http\JsonResponse;

/**
 * @group Usrr Permission Management
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
     * @param string $slug the slug of the User we want to get the Permissions from
     * @return JsonResponse
     */
    public function get(UserPermissionGetRequest $request, string $slug): JsonResponse
    {
        try {
            $user = User::where('slug', $slug)->first();
            if ($user) {
                $permission = $user->permissions;
                $response = fractal($permission, new PermissionTransformer())->toArray();
                return response()->success($response);
            } else {
                return response()->error('User not founnd', 404);
            }
        } catch (Exception $ex) {
            return response()->error($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Add User Permission
     *
     * This endpoint lets you add a Permission to a User
     * 
     * @authenticated
     * @todo 2nd parameter should autoresolve into a User model instance
     * @param UserPermissionAddRequest $request
     * @param string $slug the slug of the User we want this Permission to be added.
     * @return JsonResponse
     */
    public function add(UserPermissionAddRequest $request, string $slug): JsonResponse
    {
        try {
            $user = User::where('slug', $slug)->first();
            if ($user) {
                $user->addPermission($request->slug, $request->value);
                if ($user->save())
                    return response()->success('Permission added successfully');
                else
                    return response()->error('Failed to add permission', 400);
            } else
                return response()->error('User not found', 404);
        } catch (Exception $ex) {
            return response()->error($ex->getMessage(), $ex->getCode());
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
     * @param string $slug the slug of the User thaat we want to update Permissions
     * @return JsonResponse
     */
    public function update(UserPermissionUpdateRequest $request, string $slug): JsonResponse
    {
        try {
            $user = User::where('slug', $slug)->first();
            if ($user) {
                $user->updatePermission($request->slug, $request->value, true);
                if ($user->save())
                    return response()->success('Permission updated successfully');
                else
                    return response()->error('Failed to update permission', 400);
            } else
                return response()->error('User not found', 404);
        } catch (Exception $ex) {
            return response()->error($ex->getMessage(), $ex->getCode());
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
     * @param string $slug
     * @return JsonResponse
     */
    public function delete(UserPermissionDeleteRequest $request, string $slug): JsonResponse
    {
        try {
            $user = User::where('slug', $slug)->first();
            if ($user) {
                $user->removePermission($request->slug);
                if ($user->save())
                    return response()->success('Permission deleted successfully');
                else
                    return response()->error('Failed to delete permission', 400);
            } else
                return response()->error('User not found', 404);
        } catch (Exception $ex) {
            return response()->error($ex->getMessage(), $ex->getCode());
        }
    }
}
