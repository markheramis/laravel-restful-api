<?php

namespace App\Http\Controllers\API;

use Auth;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

/**
 * @group Auth Management
 * 
 * APIs for managing authentication
 */
class AuthController extends Controller
{
    /**
     * Me API
     * 
     * This endpoint will return the currently logged-in user.
     * 
     * @authenticated
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function me()
    {
        $user = Auth::user();
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        return response()->success($user);
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
            "firsName" => $request->firstName,
            "lastName" => $request->lastName,
        ];
        $role = $request->role;
        $activate = $request->activate === "true" ? true : false;

        try {
            if (Sentinel::validForCreation($credentials)) {
                if ($user = Sentinel::register($credentials, $activate)) {
                    $this->attachRole($user, $role);
                    return response()->success('User Registered Successfully');
                }
            } else {
                return response()->error('Could not create user');
            }
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    private function attachRole($user, $role)
    {
        $selectedRole = Sentinel::findRoleBySlug($role);
        $selectedRole->users()->attach($user);
    }
}
