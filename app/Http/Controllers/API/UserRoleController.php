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
            return response()->success($roles);
        } else {
            return response()->error('Not Found', 404);
        }
    }

    public function add(UserRoleAddRequest $request, string $slug) {
    	$user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $request->slug)->first();
        if ($user && $role) {
            $role->users()->attach($user);
            return response()->success('Attached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }

    public function delete(UserRoleDeleteRequest $request, string $slug) {
        $user = User::where('slug', $slug)->first();
        $role = Role::where('slug', $slug)->first();
        if ($user && $role) {
            $role->users()->detach($user);
            return response()->success('Detached Successfully');
        } else {
            return response()->error('Not Found', 404);
        }
    }
}
