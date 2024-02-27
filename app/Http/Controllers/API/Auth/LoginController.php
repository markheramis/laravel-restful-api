<?php

namespace App\Http\Controllers\API\Auth;

use Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Events\User\UserLoggedIn;

/**
 * @group User Management
 */
class LoginController extends Controller {

    private User $user;

    /**
     * Login API
     *
     * This endpoint allows you to login users.
     * @param App\Http\Requests\UserLoginRequest $request
     * @return JsonResponse
     */
    public function login() {
        echo "HELLO";
    }
    // public function login(UserLoginRequest $request): JsonResponse {
    //     $credentials = $this->processCredentials($request);
    //     echo "HELLO";
	//     exit();
    //     if (Auth::attempt($credentials)) {
    //         $this->user = Auth::user();
    //         $token_name = config('app.name') . ': ' . $this->user->username;
    //         $permissions = $this->user->allPermissions();
    //         $token = $this->user->createToken($token_name, $permissions)->accessToken;
    //         broadcast(new UserLoggedIn($this->user->id));
    //         return response()->success(['token' => $token]);
    //     } else {
    //         return response()->error([], 'Username or Password is Incorrect', 401);
    //     }
    // }

    private function processCredentials(UserLoginRequest $request): array {
        $login_type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        return [
            $login_type => $request->username,
            "password" => $request->password,
        ];
    }

}
