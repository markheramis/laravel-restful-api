<?php

namespace App\Http\Controllers\API;

use Sentinel;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use App\Http\Requests\RoleAllRequest;
use App\Http\Requests\RoleGetRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateReqeust;
use App\Http\Requests\RoleDeleteRequest;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class RoleController extends Controller
{
    public function index(RoleAllRequest $request)
    {
        $paginator = Role::paginate();
        $roles = $paginator->getCollection();

        $response = fractal()
            ->collection($roles)
            ->transformWith(new RoleTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json($response);
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
            $response = fractal($role, new RoleTransformer())->toArray();
            return response()->success($response);
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
                $response = fractal($role, new RoleTransformer())->toArray();
                return response()->success($response);
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
