<?php

namespace App\Http\Controllers;

use Sentinel;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;

class LoginController extends Controller
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request) {
        try{
            if ($user = $this->loginStateless($request)) {
                $token = $user->createToken('MyApp')->accessToken;
                return $this->successResponse($token);
            } else {
                return $this->failureResponse();
            }
        } catch (Exception $ex) {
            return response()->json([
                'code' => 50004,
                'message' => $ex->getMessage(),
            ], 401);
        }
    }
    
    /**
     * 
     * @param UserLoginRequest $request
     * @return type
     */
    private function loginStateless(UserLoginRequest $request)
    {
        return Sentinel::stateless([
            'email' => $request->email,
            'password' => $request->password,
          ]);
    }
    
    /**
     * 
     * @param type $token
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function successResponse($token)
    {
        return response()->json([
            'code' => 20000,
            'data' => [
                'accessToken' => $token
            ]
        ], 200);
    }
    
    /**
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    private function failureResponse()
    {
        return response()->json([
            'code' => 50004,
            'message' => 'Invalid User',
        ], 401);
    }
}
