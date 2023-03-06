<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Hashers\BcryptHasher;

class UserFactory extends Factory {


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array 
    {
        $hasher = new \App\Hashers\BcryptHasher();
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();
        $random_number = fake()->randomNumber(3, true);
        $email = $first_name . $last_name . $random_number . "@" . fake()->domainName();
        $password = $hasher->hash("password12345");
        return [
            'username' => $first_name . $last_name . $random_number,
            'email' => $email,
            'password' => $password,
            'first_name' => $first_name,
            'last_name' => $last_name,
        ];
    }

    private function __generate_random_permissions() {
        $permissions = [
            'users.all',
            'users.get',
            'users.add',
            'users.update',
            'users.delete',
            'roles.all',
            'roles.get',
            'roles.store',
            'roles.update',
            'roles.delete'
        ];
        $result = [];
        foreach ($permissions as $permission) {
            $result[$permission] = rand(0, 1);
        }
        return $result;
    }

}
