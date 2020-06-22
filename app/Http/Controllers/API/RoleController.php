<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

use App\Http\Requests\RoleAllRequest;
use App\Http\Requests\RoleGetRequest;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateReqeust;
use App\Http\Requests\RoleDeleteRequest;

class RoleController extends Controller
{
    public function all(RoleAllRequest $request) {
        $roles = Role::all();
        return response()->json([
            'status' => 'success',
            'data' => $roles,
        ], 200);
    }

    public function get(RoleGetRequest $request, string $slug) {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            return response()->json([
                'status' => 'success',
                'data' => $role,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found'
            ], 404);
        }
    }

    public function create(RoleCreateRequest $request) {
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $request->permissions,
        ]);
    }

    public function update(RoleUpdateReqeust $request, string $slug) {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->permissions = $request->permissions;
            if ($role->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Role updated successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update the role',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found'
            ], 404);
        }
    }

    public function delete(RoleDeleteRequest $request, string $slug) {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            if ($role->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Role deleted successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete the role',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Role not found',
            ], 404);
        }
    }
}
