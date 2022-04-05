<?php

namespace Database\Factories;


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
        $random_number = $this->faker->randomNumber(3, true);

        $email = $first_name . $last_name . $random_number . "@" . $this->faker->domainName();
        return [
            'username' => $first_name . $last_name . $random_number,
            'email' => $email,
            'password' => bcrypt('password12345'),
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone_number' => rand(1111111111, 9999999999),
            'country_code' => '1',

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
