<?php

namespace Database\Factories;

use Google2FA;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
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
    public function definition()
    {
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();

        $email = $first_name . $last_name . "@" . $this->faker->domainName();
        return [
            'username' => $first_name . $last_name,
            'email' => $email,
            'password' => bcrypt('password12345'),
            'first_name' => $first_name,
            'last_name' => $last_name,
            "google2fa_secret" => Google2FA::generateSecretKey(),
        ];
    }

    private function __generate_random_permissions()
    {
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

    /**
     * Configure the model factory.
     *
     * @return $this
     
    public function configure()
    {
        return $this
            ->afterMaking(function (User $user) {
            })->afterCreating(function (User $user) {
            });
    }
     */
}
