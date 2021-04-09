<?php

namespace App\Http\Controllers\API;

use Sentinel;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class AuthController extends Controller
{

    /**
     * Me API
     * 
     * This endpoint will return the currently logged-in user.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function me()
    {
        if (Sentinel::check()) {
            $user = Sentinel::getUser();
            return response()->success($user);
        } else {
            // no session
            return response()->error(null, 401);
        }
    }
    /**
     * Login API
     * 
     * This endpoint allows you to login users.
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function login(UserLoginRequest $request)
    {
        try {
            $credentials = ["password" => $request->password];
            if ($request->has("email"))
                $credentials["email"] = $request->email;
            if ($request->has("username"))
                $credentials["username"] = $request->username;
            # attempt to login
            if ($user = Sentinel::stateless($credentials)) {
                $token = $user->createToken('MyApp')->accessToken;
                return response()->success($token);
            } else {
                return response()->error('Invalid User', 401);
            }
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Register API
     * 
     * This endpoint allows you to register a new user.
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function register(UserRegisterRequest $request)
    {
        $credentials = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name
        ];
        try {
            if (Sentinel::validForCreation($credentials)) {
                if ($user = Sentinel::register($credentials)) {
                    $this->attachRole($user);
                    return response()->success('User Registered Successfully');
                }
            } else {
                return response()->error('Could not create user');
            }
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                return response()->error("Email already taken", 400);
            } else {
                return response()->error($e->getMessage(), $e->getCode());
            }
        }
    }

    private function attachRole($user)
    {
        $default_role = Sentinel::findRoleBySlug('subscriber');
        $default_role->users()->attach($user);
    }
}
