<?php
namespace Tests\Traits;

use Sentinel;
use Activation;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;

trait WithUserGenerator {

    use WithFaker;

    public function createUser($role = 'subscribers', $activated = 1) {
        $role = Role::where('slug', $role)->first();

        #$role = Sentinel::findRoleBySlug($role);
        $user = Sentinel::register(array(
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rd12345',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
        ));
        // Attache user to role
        if($user) {

            $role->users()->attach($user);

            if($activated) {
                $activation = Activation::where('user_id', $user->id)->first();
                Activation::complete($user, $activation->code); # activate all users
            }
        } else {
            return false;
        }
    }

    public function generateUser() {

    }
}
