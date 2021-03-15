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

    public function createUser(string $role = 'subscribers', bool $activated = true): User
    {
        $role = Role::where('slug', $role)->first();
        $user = User::factory()->create();
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
     * @param string $user_slug
     * @return string
     */
    public function getTokenByRole(string $role_slug, string $slug = null): string
    {
        return Role::where('slug', $role_slug)
            ->when($slug, function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->first()
            ->users()
            ->inRandomOrder()
            ->first()
            ->createToken('MyApp')
            ->accessToken;
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
