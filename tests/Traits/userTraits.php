<?php

namespace Tests\Traits;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\ActivationRepository;
use App\Repositories\RoleRepository;
trait userTraits {

    use WithFaker;

    public function createUser(string $role_slug = 'subscriber', bool $activated = TRUE): User {
        $role = Role::where('slug', $role_slug)->first();
        $user = User::factory()->create();
        // Attache user to role
        if ($user) {
            $role->users()->attach($user);
            if ($activated) {
                $activationRepository = new ActivationRepository();
                $activation = $activationRepository->get($user);
                $activationRepository->complete($user, $activation->code);
            }
            return $user;
        } else {
            return false;
        }
    }

    public function createRole(array $role_data) {
        $roles = new RoleRepository();
        return  $roles->createModel()->create($role_data);
    }

    /**
     * Get passport token from a user that matches the role slug and/or user slug
     *
     * @param string $role_slug
     * @param int $user_id
     * @return string
     */
    public function getTokenByRole(string $role_slug, int $user_id = null,): string {
        $user = Role::where('slug', $role_slug)
                ->first()
                ->users()
                ->when(
                        $user_id != null,
                        function ($query) use ($user_id) {
                            $query->where('users.id', $user_id);
                        },
                        function ($query) {
                            $query->inRandomOrder();
                        }
                )
                ->first();
        return $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken;
    }

    public function getUserSlugByRoleSlug(string $role_slug): string {
        $user = Role::where('slug', $role_slug)
                ->users()
                ->inRandomOrder()
                ->first();
        return $user->slug;
    }

}
