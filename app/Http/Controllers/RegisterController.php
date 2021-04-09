<?php

namespace App\Http\Controllers;

use Sentinel;
use Exception;

use App\Http\Requests\UserRegisterRequest;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
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
            if ($user = Sentinel::register($credentials)) {
                $this->attachRole($user);
                return $this->successResponse();
            } else
                return $this->errorResponse();
        } catch (Exception $ex) {
            if ($ex->getCode() == 23000)
                return $this->errorResponse("Email already taken");
            else
                return $this->errorResponse($ex->getMessage());
        }
    }

    private function attachRole($user)
    {
        $default_role = Sentinel::findRoleBySlug('subscriber');
        $default_role->users()->attach($user);
    }

    /**
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function successResponse()
    {
        return response()->success('User Registered Successfully');
    }

    /**
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function errorResponse($message = 'User Registration failed')
    {
        return response()->error($message, 400);
    }
}
