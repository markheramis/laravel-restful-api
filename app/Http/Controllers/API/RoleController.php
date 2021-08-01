<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Transformers\RoleTransformer;
use App\Http\Requests\RoleAllRequest;
use App\Http\Requests\RoleShowRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateReqeust;
use App\Http\Requests\RoleDeleteRequest;
use App\Http\Requests\RoleIndexRequest;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;
use Illuminate\Http\JsonResponse;

/**
 * @group Role Management
 * 
 * APIs for managing Roles
 */
class RoleController extends Controller
{
    /**
     * Get all Roles
     * 
     * This endpoint lets you get all the Roles
     *
     * @authenticated
     * @param RoleAllRequest $request
     * @uses App\Models\Role $paginator
     * @uses App\Transformers\RoleTransformer RoleTransformer
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @return JsonResponse
     */
    public function index(RoleIndexRequest $request): JsonResponse
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
     * Store a Role
     * 
     * This endpoint lets you store a new Role
     * 
     * @authenticated
     * @param RoleStoreRequest $request
     * @return JsonResponse
     */
    public function store(RoleStoreRequest $request): JsonResponse
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
            /* 'permissions' => $request->permissions, */
        ];
        $role = Role::create($data);
        if ($role) {
            $response = fractal($role, new RoleTransformer())->toArray();
            return response()->success($response);
        } else {
            return response()->error('Failed to create role');
        }
    }

    /**
     * Show a Role
     * 
     * This endpoint lets you get a Role
     *
     * @authenticated
     * @todo 2nd parameter should auto resolve to the Role model instance
     * @param RoleShowRequest $request
     * @param App\Models\Role $role auto resolved instance of Eloquent Role
     * @uses App\Transformers\RoleTransformer RoleTransformer
     * @return JsonResponse
     */
    public function show(RoleShowRequest $request, Role $role): JsonResponse
    {
        $response = fractal($role, new RoleTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Update a Role
     * 
     * This endpoint lets you update a single Role
     *
     * @authenticated
     * @todo 2nd parameter should autoresolve to Role model instance.
     * @param RoleUpdateReqeust $request
     * @param App\Models\Role $role auto resolved instance of Eloquent Role
     * @uses App\Models\Role $role
     * @return JsonResponse
     */
    public function update(RoleUpdateReqeust $request, Role $role): JsonResponse
    {
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->permissions = $request->permissions;
        if ($role->update()) {
            $response = fractal($role, new RoleTransformer())->toArray();
            return response()->success($response);
        } else {
            return response()->error('Failed to update role', 400);
        }
    }

    /**
     * Delete a Role
     * 
     * This endpoint lets you delete a single Role
     *
     * @authenticated
     * @todo add body parameter `force` that allows force delete when user is an admin.
     * @param RoleDeleteRequest $request
     * @param App\Models\Role $role auto resolved instance of Eloquent Role
     * @uses App\Models\Role $role
     * @return JsonResponse
     */
    public function destroy(RoleDeleteRequest $request, Role $role): JsonResponse
    {
        if ($role->delete()) {
            return response()->success('Role deleted successfully');
        } else {
            return response()->error('Failed to delete role', 500);
        }
    }
}
