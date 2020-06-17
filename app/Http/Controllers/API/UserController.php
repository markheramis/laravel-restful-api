<?php

namespace App\Http\Controllers\API;

use Validator;
use Sentinel;
use Activation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Http\Requests\UserAllRequest;


class UserController extends Controller
{
    public function all(UserAllRequest $request) {
        $users = User::paginate();
        return response()->json($users, 200);
    }

    public function get(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
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
            'permissions' => 'array',
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
                $user->permissions = [
                    'view.profile' => true,
                    'update.profile' => true,
                ];
                $role = Sentinel::findRoleBySlug('subscribers');
                $role->users()->attach($user);
                $user->save();
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
    public function update(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
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

    public function delete(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
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

    public function get_role(Request $request, string $user_slug) {
        $user = Sentinel::findBySlug($user_slug);
        if ($user) {
            $roles = $user->roles;
            return response()->json(['status' => 'success', 'data' => $roles], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account not found'], 404);
        }
    }

    public function add_role(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
        $role = Sentinel::findRoleBySlug($request->slug);
        if ($user && $role) {
            $role->users()->attach($user);
            return response()->json(['status' => 'success', 'message' => 'Role attached successfully'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account or Role not found'], 404);
        }
    }

    public function remove_role(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
        $role = Sentinel::findRoleBySlug($request->slug);
        if ($user && $role) {
            $role->users()->detach($user);
            return response()->json(['status' => 'success', 'message' => 'Role detached successfully'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account or Role not found'], 404);
        }
    }

    public function get_permission(Request $request, string $user_slug) {
        $user = Sentinel::findBySlug($user_slug);
        if ($user) {
            $permission = $user->permissions;
            return response()->json(['status' => 'success', 'data' => $permission], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account not found'], 404);
        }
    }

    public function add_permission(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
        if ($user) {
            $user->addPermission($request->slug, $request->value);
            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'Permission added successfully'], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to add Permission'], 400);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account not found'], 404);
        }
    }

    public function update_permission(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
        if ($user) {
            $user->updatePermission($request->slug, $request->value, true);
            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'Permission updated successfully'], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to update Permission'], 400);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account not found'], 404);
        }
    }

    public function remove_permission(Request $request, string $slug) {
        $user = Sentinel::findBySlug($slug);
        if ($user) {
            $user->removePermission($request->slug);
            if ($user->save()) {
                return response()->json(['status' => 'success', 'message' => 'Permission removed successfully'], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Failed to remove Permission'], 400);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Account not found'], 404);
        }
    }
}
