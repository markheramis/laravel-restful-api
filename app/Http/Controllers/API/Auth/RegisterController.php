<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRegisterRequest;
use App\Events\User\UserCreated;
use App\Repositories\ActivationRepository;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

/**
 * @group User Management
 */
class RegisterController extends Controller {

    /**
     * The activation repository
     *
     * @var ActivationRepository
     */
    protected $activations;

    /**
     * The user repository
     *
     * @var \App\Repositories\UserRepository
     */
    protected $users;

    /**
     * The role repository
     *
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    /**
     *
     * @param UserRepository $users dependency injected instance of UserRepository
     * @param RoleRepository $roles dependency injected instance of RoleRepository
     */
    public function __construct(
            ActivationRepository $activations,
            UserRepository $users,
            RoleRepository $roles
    ) {
        $this->activations = $activations;
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Register API
     *
     * This endpoint allows you to register a new user.
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse {
        $credentials = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "permissions" => $request->permissions,
            "phone_number" => $request->phone_number,
            "country_code" => $request->country_code
        ];
        #if ($request->activate) {
        /**
         * @todo put this in the UserRegisterRequest
         */
        $valid = $this->users->validForCreation($credentials);
        if (!$valid) {
            return response()->error([], 401);
        }
        $user = $this->users->create($credentials);
        $activation = $this->activations->create($user);
        if ($request->has('activate') && $request->activate == true) {
            $this->activations->complete($user, $activation->code);
        }
        $role = ($request->has('role')) ? $request->role : 'subscriber';
        $this->attachRole($user, $role);
        UserCreated::dispatch($user->id, $role, $request->all());
        $this->attachRole($user, 'subscriber');
        return response()->success($user);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param string $role
     * @return void
     */
    private function attachRole(User $user, string $role) {
        $selectedRole = $this->roles->findBySlug($role);
        $selectedRole->users()->attach($user);
    }

}
