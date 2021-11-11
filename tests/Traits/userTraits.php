<?php

namespace Tests\Traits;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;


trait userTraits
{

    use WithFaker;

    public function createUser(string $role = 'subscriber', bool $activated = true, bool $mfa_enabled = false): User
    {
        $role = Role::where('slug', $role)->first();
        $user = User::factory([
            'authy_id' => $mfa_enabled ? 'xxx' : ''
        ])->create();
        // Attache user to role
        if ($user) {
            $role->users()->attach($user);
            if ($activated) {
                /**
                 * @var Cartalyst\Sentinel\Laravel\Facades\Activation
                 */
                $activation = Activation::where('user_id', $user->id)->first();
                Activation::complete($user, $activation->code); # activate all users
            }
            return $user;
        } else {
            return false;
        }
    }

    public function createRole(array $role_data)
    {
        $role = Sentinel::getRoleRepository()->createModel()->create($role_data);
        return $role;
    }

    /**
     * Get passport token from a user that matches the role slug and/or user slug
     *
     * @param string $role_slug
     * @param int $user_id
     * @return string
     */
    public function getTokenByRole(string $role_slug, int $user_id = null, $mfa_verified = false): string
    {
        $user = Role::where('slug', $role_slug)
            ->first()
            ->users()
            ->when($user_id != null, function ($query) use ($user_id) {
                $query->where('users.id', $user_id);
            }, function ($query) {
                $query->inRandomOrder();
            })
            ->first();
        if ($mfa_verified) {
            session()->now('mfa_verified', true);
        }
        return $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken;
    }

    public function getUserSlugByRoleSlug(string $role_slug): string
    {
        return Role::where('slug', $role_slug)
            ->first()
            ->users()
            ->inRandomOrder()
            ->first()
            ->slug;
    }
}
