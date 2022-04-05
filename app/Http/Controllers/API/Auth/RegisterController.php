<?php

namespace App\Http\Controllers\API\Auth;

use Sentinel;
use Authy\AuthyApi;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\Http\Requests\User\UserRegisterRequest;
use App\Events\User\UserCreated;


/**
 * @group User Management
 */
class RegisterController extends Controller
{
    /**
     * Register API
     *
     * This endpoint allows you to register a new user.
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $authy_id = $this->create_authy_api($request);
        $credentials = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "permissions" => $request->permissions,
            "phone_number" => $request->phone_number,
            "country_code" => $request->country_code,
            "authy_id" => $authy_id
        ];
        $user = Sentinel::register($credentials);
        $role = ($request->has('role')) ? $request->role : 'subscriber';
        $this->attachRole($user, $role);
        UserCreated::dispatch($user->id, $role, $request->all());
        $response = fractal($user, new UserTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param string $role
     * @return void
     */
    private function attachRole(User $user, string $role)
    {
        \Log::info("RegisterController::attachRole " . $role);
        $selectedRole = Sentinel::findRoleBySlug($role);
        $selectedRole->users()->attach($user);
    }

    /**
     * Undocumented function
     *
     * @param UserRegisterRequest $request
     * @return void
     */
    private function create_authy_api(UserRegisterRequest $request)
    {
        $is_not_local = config('app.env') !== "local";
        $has_authy = config('authy.app_id') && config('authy.app_secret');
        if ($is_not_local && $has_authy) {
            $authy_api = new AuthyApi(config('authy.app_secret'));
            // register the user to the authy users database
            $response = $authy_api->registerUser(
                $request->email,
                $request->phone_number,
                $request->country_code
            );
            return $response->id();
        } else {
            return null;
        }
    }
}
