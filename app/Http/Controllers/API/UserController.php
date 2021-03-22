<?php

namespace App\Http\Controllers\API;

use Log;
use Sentinel;
use Activation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\UserAllRequest;
use App\Http\Requests\UserGetRequest;
use App\Http\Requests\UserActivateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDeleteRequest;


use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class UserController extends Controller
{
    public function me()
    {
        return response()->json(Auth::user());
    }

    public function all(UserAllRequest $request)
    {
        $paginator = User::paginate();
        $users = $paginator->getCollection();
        $response = fractal()
            ->collection($users)
            ->transformWith(new UserTransformer())
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json($response, 200);
    }

    public function get(UserGetRequest $request, string $slug)
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
     * Undocumented function
     *
     * @param App\Http\Requests\UserActivateRequest $request
     * @param string $slug the user slug
     * @param string $code the activation code
     * @return JSON
     */
    public function activate(UserActivateRequest $request)
    {
        $data = ['uuid' => $request->uuid];
        if ($user = User::where($data)->first()) {
            if (Activation::complete($user, $request->code))
                return response()->success('User activated');
            else
                return response()->error('Failed to activate user');
        } else
            return response()->error('Activation not found', 404);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @return JSON
     */
    public function update(UserUpdateRequest $request, string $slug)
    {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            $user->username = $request->username;
            $user->email = $request->email;
            if ($user->save())
                return response()->success('User updated', 201);
            else
                return response()->error('Failed to update user');
        } else
            return response()->error('User not found', 404);
    }

    public function delete(UserDeleteRequest $request, string $slug)
    {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            if ($user->delete())
                return response()->success('User deleted successfully');
            else
                return response()->error('Failed to delete user');
        } else
            return response()->error('User not found', 404);
    }
}
