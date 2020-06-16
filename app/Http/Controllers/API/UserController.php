<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Sentinel;
use Activation;

class UserController extends Controller
{
    public function all(Request $request) {
        $users = User::paginate();
        return response()->json([
          'status' => 'success',
          'data' => $users,
        ], 200);
    }

    public function single(Request $request, Integer $id) {
        $user = User::find($id);
        if($user) {
            return response()->json([
              'status' => 'success',
              'data' => $user,
            ], 200);
        } else {
            return response()->json([
              'status' => 'error',
              'message' => 'User not found',
            ], 404);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'v_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $response = [
                'status' => 'error',
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        $credentials = $request->all();

        $user = Sentinel::register($credentials);
        if ($user) {
            if ($activation = Activation::create($user)) {
                return response()->json([
                  'status' => 'success',
                  'data' => $user->createToken('MyApp')->accessToken,
                  'message' => 'User register successfully.'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Failed to create activation'
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user'
            ], 500);
        }
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => 'Validation Error.',
                'message' => $validator->errors()
            ], 400);
        }
        if ($user = Sentinel::stateless([
            'email' => $request->email,
            'password' => $request->password,
          ])) {
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'status' => 'success',
                'data' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized access',
            ], 401);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param integer $id
     * @param string $code
     * @return JSON
     */
    public function activate(Request $request, int $id, string $code) {
        if ($user = User::find($id)) {
            if (Activation::complete($user, $code)) {
                return response()->json([
                    'status' => 'success'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error'
                ], 404);
            }
        } else {
            return response()->json([
                'status' => 'error',
            ], 404);
        }
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

    public function delete(Request $request, int $id) {
        $user = User::find($id);
        if($user) {
            if ($user->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User deleted successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to delete the user',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
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
