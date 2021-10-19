<?php

namespace App\Http\Controllers\API;

use DB;
use Auth;
use Sentinel;
use Activation;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Transformers\UserTransformer;
use App\Http\Requests\UserIndexRequest;
use App\Http\Requests\UserShowRequest;
use App\Http\Requests\UserActivateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserEmailRequest;
use App\Http\Requests\UserResetPasswordRequest;
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
     * Get all Users
     * 
     * This endpoint lets you get all Users.
     * 
     * @authenticated
     * @todo add role based search.
     * @queryParam search string used to search from email, username, first_name, and last_name
     * @param UserAllRequest $request
     * @uses App\Models\User $rolePaginator
     * @uses App\Transformers\UserTransformer UserTransformer
     * @uses League\Fractal\Pagination\IlluminatePaginatorAdapter IlluminatePaginatorAdapter
     * @uses League\Fractal\Serializer\JsonApiSerializer JsonApiSerializer
     * @return JsonResponse
     */
    public function index(UserIndexRequest $request): JsonResponse
    {
        $rolePaginator = User::when($request->search, function ($query) use ($request) {
            $search = $request->search;
            $query->where("email", "LIKE", "%$search%")
                ->orWhere("username", "LIKE", "%$search%")
                ->orWhere("first_name", "LIKE", "%$search%")
                ->orWhere("last_name", "LIKE", "%$search%");
        })->paginate();


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
     * @param App\Models\User $user
     * @uses App\Models\User $user
     * @uses App\Transformers\UserTransformer UserTransformer
     * @return JsonResponse
     */
    public function show(UserShowRequest $request, User $user): JsonResponse
    {
        $response = fractal($user, new UserTransformer())->toArray();
        return response()->success($response);
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
     * @param App\Models\User $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $user->username = $request->username;
        $user->email = $request->email;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->update();
        return response()->success($user);
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
    public function destroy(UserDestroyRequest $request, User $user): JsonResponse
    {
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
    public function me(): JsonResponse
    {
        $user = Auth::user();
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        return response()->success($user);
    }

 
    /**
     * Forgot Password
     *
     * This endpoint will send an authorized email reset password 
     * 
     * @uses App\Models\User $user
     * @param UserEmailRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(UserEmailRequest $request): JsonResponse
    {
        if ($user = user::whereEmail($request->email)->first()) {
            $password_reset = [
                'email' => $request->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ];
            
            DB::table('password_resets')->insert($password_reset);
            $url = env('DENTALRAY_APP_URL').'/reset-password?token='.$password_reset['token'];

            Mail::to($user->email)
            ->send(new ForgotPasswordMail(array_merge($password_reset, [
                'url' => $url
            ])));
            return response()->success('Please check your email to reset your password');
        }
        return response()->error("Email doesn't exist", 403);
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
    public function resetPassword(UserResetPasswordRequest $request): JsonResponse
    {
        $password_reset = DB::table('password_resets')->where('token', $request->token);
        if ($user_password_reset = $password_reset->first()) {
            $user = user::whereEmail($user_password_reset->email)->first();
            Sentinel::update($user, array('password' => $request->password));
            $password_reset->delete();
            return response()->success('Reset password successfully');
        }
        return response()->error('Forbidden reset password', 403);
    }
}
