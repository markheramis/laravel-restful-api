<?php

namespace App\Http\Controllers\API;

use Sentinel;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\RoleAllRequest;
use App\Http\Requests\RoleGetRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateReqeust;
use App\Http\Requests\RoleDeleteRequest;

class RoleController extends Controller
{
    public function index(RoleAllRequest $request)
    {
        $roles = Role::all();
        return response()->success($roles);
    }

    /**
     * Undocumented function
     *
     * @param RoleGetRequest $request
     * @param string $slug
     * @return void
     */
    public function get(RoleGetRequest $request, string $slug)
    {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            return response()->success($role);
        } else {
            return response()->error('Role not found', 404);
        }
    }

    /**
     * Undocumented function
     *
     * @param RoleCreateRequest $request
     * @return void
     */
    public function store(RoleStoreRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            'permissions' => $request->permissions,
        ];
        $role = Sentinel::getRoleRepository()->createModel()->create($data);
        if ($role) {
            return response()->success('Role created successfully');
        } else {
            return response()->error('Failed to create role');
        }
    }

    /**
     * Undocumented function
     *
     * @param RoleUpdateReqeust $request
     * @param string $slug
     * @return void
     */
    public function update(RoleUpdateReqeust $request, string $slug)
    {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            $role->name = $request->name;
            $role->slug = $request->slug;
            $role->permissions = $request->permissions;
            if ($role->save()) {
                return response()->success('Role updated successfully');
            } else {
                return response()->error('Failed to update role', 400);
            }
        } else {
            return response()->error('Role not found', 404);
        }
    }

    /**
     * Undocumented function
     *
     * @param RoleDeleteRequest $request
     * @param string $slug
     * @return void
     */
    public function delete(RoleDeleteRequest $request, string $slug)
    {
        $role = Sentinel::findRoleBySlug($slug);
        if ($role) {
            if ($role->delete()) {
                return response()->success('Role deleted successfully');
            } else {
                return response()->error('Failed to delete role');
            }
        } else {
            return response()->error('Role not found', 404);
        }
    }
}
