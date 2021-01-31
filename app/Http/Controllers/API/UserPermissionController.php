<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
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
     * @param string $slug
     * @return void
     */
    public function get(UserPermissionGetRequest $request, string $slug)
    {
        try {
            $user = User::where('slug', $slug)->first();
            if ($user) {
                $permission = $user->permissions;
                return response()->json([
                    'status' => 'success',
                    'data' => $permission
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
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
                if ($user->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Permission added successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to add Permission'
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
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
                if ($user->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Permission updated successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to update Permission'
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
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
                if ($user->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Permission removed successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to remove Permission'
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found'
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
            ], $ex->getCode());
        }
    }
}
