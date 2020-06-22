<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Role;

use App\Http\Requests\UserRoleGetRequest;
use App\Http\Requests\UserRoleAddRequest;
use App\Http\Requests\UserRoleDeleteRequest;

class UserRoleController extends Controller
{
    public function get(UserRoleGetRequest $request, string $slug) {
        $user = User::where('slug', $slug)->first();
        if ($user) {
            $roles = $user->roles;
            return response()->json([
            	'status' => 'success', 
            	'data' => $roles
            ], 200);
        } else {
            return response()->json([
            	'status' => 'error', 
            	'message' => 'Account not found'
            ], 404);
        }
    }

    public function add(UserRoleAddRequest $request, string $slug) {
    	$user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $request->slug)->first();
        if ($user && $role) {
            $role->users()->attach($user);
            return response()->json([
            	'status' => 'success', 
            	'message' => 'Role attached successfully'
            ], 200);
        } else {
            return response()->json([
            	'status' => 'error', 
            	'message' => 'Account or Role not found'
            ], 404);
        }
    }

    public function delete(UserRoleDeleteRequest $request, string $slug) {
        $user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $slug)->first();
        if ($user && $role) {
            $role->users()->detach($user);
            return response()->json([
            	'status' => 'success', 
            	'message' => 'Role detached successfully'
            ], 200);
        } else {
            return response()->json([
            	'status' => 'error', 
            	'message' => 'Account or Role not found'
            ], 404);
        }
    }
}
