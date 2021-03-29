<?php

namespace App\Http\Controllers\API;

use Log;
use Sentinel;
use Activation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\UserAllRequest;
use App\Http\Requests\UserGetRequest;
use App\Http\Requests\UserActivateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDeleteRequest;


use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

/**
 * @group  User Management
 * 
 * APIs for managnign Users
 */
class UserController extends Controller
{
    /**
     * Get current User
     * 
     * This endpoint lets you get the currently logged in User.
     * @authenticated
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    /**
     * Get all Users
     * 
     * This endpoint lets you get all Users.
     * 
     * @authenticated
     * @param UserAllRequest $request
     * @uses App\Models\User $rolePaginator
     * @uses App\Transformers\UserTransformer UserTransformer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @return JsonResponse
     */
    public function all(UserAllRequest $request): JsonResponse
    {
        $rolePaginator = User::paginate();
        $users = $rolePaginator->getCollection();
        $response = fractal()
            ->collection($users)
            ->transformWith(new UserTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($rolePaginator))
            ->toArray();
        return response()->json($response, 200);
    }

    /**
     * Get a User
     * 
     * This endpoint lets you get a User.
     *
     * @authenticated
     * @todo 2nd parameter should auto resolve into a User model instance
     * @param UserGetRequest $request
     * @param string $slug the slug of the user to update.
     * @uses App\Models\User $user
     * @uses App\Transformers\UserTransformer UserTransformer
     * @return JsonResponse
     */
    public function get(UserGetRequest $request, string $slug): JsonResponse
    {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            $response = fractal($user, new UserTransformer())->toArray();
            return response()->success($response, 200);
        } else {
            return response()->error('User not found', 404);
        }
    }


    /**
     * Activate a User
     * 
     * This endpoint lets you activate a User.
     *
     * @authenticated
     * @param App\Http\Requests\UserActivateRequest $request
     * @return JsonResponse
     */
    public function activate(UserActivateRequest $request): JsonResponse
    {
        $data = ['uuid' => $request->uuid];
        if ($user = User::where($data)->first()) {
            if (Activation::complete($user, $request->code)) {
                return response()->success('User activated');
            } else {
                return response()->error('Failed to activate user');
            }
        } else {
            return response()->error('Activation not found', 404);
        }
    }

    /**
     * Update a User
     * 
     * This endpoint lets you update a User's data.
     *
     * @authenticated
     * @todo 2nd paramter $slug should auto resolve to a User model instance
     * @param UserUpdateRequest $request
     * @param string $slug the slug of the user to update.
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, string $slug): JsonResponse
    {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            $user->username = $request->username;
            $user->email = $request->email;
            if ($user->save()) {
                return response()->success('User updated', 201);
            } else {
                return response()->error('Failed to update user');
            }
        } else {
            return response()->error('User not found', 404);
        }
    }

    /**
     * Delete a User
     * 
     * This endpoint lets you update a User.
     *
     * @authenticated
     * @todo 2nd parameter $slug should auto resolve to a User model instance
     * @param UserDeleteRequest $request
     * @param string $slug the slug of the user to delete.
     * @return JsonResponse
     */
    public function delete(UserDeleteRequest $request, string $slug): JsonResponse
    {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            if ($user->delete()) {
                return response()->success('User deleted successfully');
            } else {
                return response()->error('Failed to delete user');
            }
        } else {
            return response()->error('User not found', 404);
        }
    }
}
