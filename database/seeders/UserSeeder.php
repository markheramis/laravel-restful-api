<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\ActivationRepository;

class UserSeeder extends Seeder {

    protected ActivationRepository $activation;

    public function __construct(ActivationRepository $activation) {
        $this->activation = $activation;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = User::factory()->count(10)->create();
        $this->__attach_users_to_role($users, 'administrator');
        $users = User::factory()->count(10)->create();
        $this->__attach_users_to_role($users, 'moderator');
        $users = User::factory()->count(10)->create();
        $this->__attach_users_to_role($users, 'subscriber');

        $admin = User::first();
        $admin->username = 'admin';
        $admin->update();
    }

    private function __attach_users_to_role(Collection $users, string $role_slug) {
        $role = Role::where('slug', $role_slug)->first();
        $users->map(function ($user) use ($role) {
            # automaticall activate generated users
            $activation = $user->activations->first();
            $this->activation->complete($user, $activation->code);
            # attached given role
            $role->users()->attach($user);
            return $user;
        });
    }

}
