<?php

namespace App\Http\Controllers\API\Auth;

use Log;
use Sentinel;
use App\Models\User;
use App\Events\User\UserLoggedIn;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;

/**
 * @group User Management
 */
class LoginController extends Controller
{

    /**
     * Login API
     *
     * This endpoint allows you to login users.
     * @param App\Http\Requests\UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $credentials = $this->processCredentials($request);
        # attempt to login
        if ($user = Sentinel::stateless($credentials)) {
            $token = $this->createToken($user);
            broadcast(new UserLoggedIn($user->id));
            $response = [
                "token" => $token,
            ];
            return response()->success($response);
        } else {
            return response()->error([], 'Username or Password is Incorrect', 401);
        }
    }

    /**
     * Generate a token from the User
     *
     * @param User $user
     * @return string
     */
    private function createToken(User $user): string
    {
        return $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken;
    }

    /**
     * Undocumented function
     *
     * @param UserLoginRequest $request
     * @return array
     */
    private function processCredentials(UserLoginRequest $request): array
    {
        $login_type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $login_type => $request->username,
            "password" => $request->password,
        ];
    }
}
