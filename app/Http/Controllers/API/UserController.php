<?php


namespace App\Http\Controllers\API;


use DB;
use Auth;
use Activation;
use App\Models\Role;
use App\Models\User;
use App\Mail\UserForgotPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Transformers\UserTransformer;

use App\Http\Requests\User\UserMeRequest;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserDestroyRequest;
use App\Http\Requests\User\UserForgetPasswordRequest;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Requests\User\UserActivateRequest;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;

/**
 * @group  User Management
 *
 * APIs for managnign Users
 */
class UserController extends Controller {


    /**
     * The users repository
     * @var \App\Repositories\UserRepository
     */
    protected UserRepository $users;

    /**
     * The role repository
     * 
     * @var \App\Repositories\RoleRepository
     */
    protected RoleRepository $roles;

    public function __construct(UserRepository $users, RoleRepository $roles) {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * Get all Users
     *
     * This endpoint lets you get all Users.
     *
     * @authenticated
     * @todo add role based search.
     * @queryParam search string used to search from email, username
     * @queryParam role string used to filter results based on a specific role.
     * @param UserAllRequest $request
     * @uses App\Models\User $userPaginator
     * @uses App\Transformers\UserTransformer UserTransformer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @return JsonResponse
     */
    public function index(UserIndexRequest $request): JsonResponse {
        $userPaginator = User::when(
                        $request->filter_by,
                        fn($query) => $query->where($request->filter_by, 'LIKE', "%$request->filter_value%"),
                )->when($request->has("role"), function ($query) use ($request) {
                    $role = $request->role;
                    $query->whereHas("roles", function ($q) use ($role) {
                        $q->where('slug', $role);
                    });
                })->paginate();
        $userCollection = $userPaginator->getCollection();
        $response = fractal()
                ->collection($userCollection)
                ->transformWith(new UserTransformer())
                ->serializeWith(new JsonApiSerializer())
                ->paginateWith(new IlluminatePaginatorAdapter($userPaginator))
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
     * @param App\Models\User $user
     * @uses App\Models\User $user
     * @uses App\Transformers\UserTransformer UserTransformer
     * @return JsonResponse
     */
    public function show(UserShowRequest $request, User $user): JsonResponse {
        $response = fractal($user, new UserTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Activate a User
     *
     * This endpoint lets you activate a User.
     *
     * @authenticated
     * @param App\Http\Requests\User\UserActivateRequest $request
     * @return JsonResponse
     */
    public function activate(UserActivateRequest $request): JsonResponse {
        if ($activation = Activation::where('code', $request->code)->first()) {
            $user = $activation->user;
            if (Activation::complete($user, $request->code)) {
                return response()->success('User activated');
            } else {
                return response()->error([], 'Failed to activate user');
            }
        } else {
            return response()->error([], 'Activation not found', 404);
        }
    }

    /**
     * Store User
     *
     * This endpoint lets you create a new User.
     *
     * @authenticated
     * @param App\Http\Requests\UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse {
        $activate = (bool) $request->activate;
        $credentials = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "permissions" => $request->permissions,
            "phone_number" => $request->phone_number,
            "country_code" => $request->country_code
        ];
        if (!$this->users->validForCreation($credentials)) {
            return response()->error([], 400);
        }
        $user = $this->users->create($credentials);
        if ($activate) {
            /**
             * @todo this is wrong activation method, we should not use redirect in an API
             * @description problem with this is its probably gonna block the execution if $activation is true.
             */
            redirect('api.user.activate')->with('data', $user->toArray());
        }
        $role = ($request->has('role')) ? $request->role : 'subscriber';
        $this->attachRole($user, $role);
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
    private function attachRole(User $user, string $role) {
        $selectedRole = $this->roles->findBySlug($role);
        $selectedRole->users()->attach($user);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Role $role
     * @return void
     */
    private function detachRole(User $user, Role $role) {
        $role->users()->detach($user);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    private function detachAllRoles(User $user) {
        $roles = $user->roles()->get();
        foreach ($roles as $role) {
            $this->detachRole($user, $role);
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
     * @param App\Models\User $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse {
        if($request->has('username')) {
            $user->username = $request->username;
        }
        if($request->has('email')) {
            $user->email = $request->email;
        }
        $user->update();
        $response = fractal($user, new UserTransformer())->toArray();
        return response()->success($response);
    }

    /**
     * Destroy a User
     *
     * This endpoint lets you update a User.
     *
     * @authenticated
     * @todo 2nd parameter $slug should auto resolve to a User model instance
     * @param UserDestroyRequest $request
     * @param App\Models\User $user
     * @return JsonResponse
     */
    public function destroy(UserDestroyRequest $request, User $user): JsonResponse {
        $user->delete();
        return response()->success('User deleted successfully');
    }

    /**
     * Me API
     *
     * This endpoint will return the currently logged-in user.
     *
     * @authenticated
     * @return JsonResponse
     */
    public function me(UserMeRequest $request): JsonResponse {
        $user = Auth::user();
        $response = $user->with('roles')->first();
        return response()->success($response);
    }

    /**
     * Forgot Password
     *
     * This endpoint will send an authorized email reset password
     *
     * @uses App\Models\User $user
     * @param UserForgetPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(UserForgetPasswordRequest $request): JsonResponse {
        if ($user = user::whereEmail($request->email)->first()) {
            $password_reset = [
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ];

            DB::table('password_resets')->insert($password_reset);
            $url = env('DENTALRAY_APP_URL') . '/reset-password?token=' . $password_reset['token'];

            Mail::to($user->email)
                    ->send(new UserForgotPasswordMail(array_merge($password_reset, [
                                        'url' => $url
            ])));
            return response()->success('Please check your email to reset your password');
        }
        return response()->error([], "Email doesn't exist", 404);
    }

    /**
     * Reset Password
     *
     * This endpoint lets you reset and update password
     *
     * @uses App\Models\User $user
     * @param UserResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(UserResetPasswordRequest $request): JsonResponse {
        $password_reset = DB::table('password_resets')
                ->where('token', $request->token)
                ->first();
        if ($user_password_reset === $password_reset->first()) {
            if ($request->password != $request->confirm_password) {
                return response()->error([], "Password doesn't match!", 403);
            }
            $user = user::whereEmail($user_password_reset->email)->first();
            $this->users->update($user, ['password' => $request->password]);
            $password_reset->delete();
            return response()->success('Reset password successfully');
        }
        return response()->error([], "Token doesn't exist", 404);
    }

    /**
     * Change Password
     *
     * This endpoint lets users change their own passwords
     *
     * @authenticated
     *
     * @param UserChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(UserChangePasswordRequest $request): JsonResponse {
        try {
            $this->users->update(Auth::user(), ['password' => $request->password]);
            return response()->success("User Updated Successfully");
        } catch (\Exception $e) {
            return response()->error([], $e->getMessage());
        }
    }

}
