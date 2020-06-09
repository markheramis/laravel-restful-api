<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'v_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 404);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User register successfully.'
        ];

        return response()->json($response, 200);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;

            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @return JSON
     */
    public function deactivate(Request $request, int $id) {

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @return JSON
     */
    public function reactivate(Request $request, int $id) {

    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @return JSON
     */
    public function update(Request $request, int $id) {
        $user = User::find($id);
        if($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if($user->save()) {
                return response()->json(['success' => 'User updated'], 201);
            } else {
                return response()->json(['error' => 'User not updated'],500);
            }
        } else {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @return JSON
     */
    public function change_password(Request $request, int $id) {
        $user = User::find($id);
        if($user) {

        } else {
            return response()->json(['error' => 'Not Found'], 404);
        }
    }
}
