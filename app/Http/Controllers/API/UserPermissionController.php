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

class UserPermissionController extends Controller
{

    /**
     * Get User Permission
     *
     * @param UserPermissionGetRequest $request
     * @param string $user_slug
     * @return void
     */
    public function get(UserPermissionGetRequest $request, string $user_slug)
    {
        try {
            $user = User::where('slug', $user_slug)->first();
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
     * @param UserPermissionAddRequest $request
     * @param string $slug
     * @return void
     */
    public function add(UserPermissionAddRequest $request, string $slug)
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
     * @param UserPermissionUpdateRequest $request
     * @param string $slug
     * @return void
     */
    public function update(UserPermissionUpdateRequest $request, string $slug)
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
     * @param UserPermissionDeleteRequest $request
     * @param string $slug
     * @return void
     */
    public function delete(UserPermissionDeleteRequest $request, string $slug)
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
