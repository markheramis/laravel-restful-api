<?php

namespace App\Http\Controllers;

use Sentinel;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\UserRegisterRequest;

class RegisterController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request) {
        $credentials = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name
        ];
        try{
            if($user = Sentinel::register($credentials)) {
                $this->attachRole($user);
                return $this->successResponse();
            } else {
                
                dd($user);
                return $this->errorResponse();
            }
        } catch (Exception $ex) {
            if($ex->getCode() == 23000) {
                return $this->errorResponse("Email already taken");
            } else {
                return $this->errorResponse($ex->getMessage());
            }
        }
    }
    
    private function attachRole($user)
    {
        /**
         * Attach default Role
         */
        $default_role = Sentinel::findRoleBySlug('subscribers');
        $default_role->users()->attach($user);
    }
    
    /**
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function successResponse()
    {
        return response()->json([
           'status' => 'success',
           'message' => 'User Registered Successfully',
        ], 200);
    }
    
    /**
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function errorResponse($message = 'User Registration failed')
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], 400);
    }
}
