<?php

namespace Tests\Feature\User\Register;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterRoleFieldTest extends TestCase
{
    use WithFaker;

    public function testRegisterWithNoRoleShouldCreateUserWithDefaultRole()
    {
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        $random_number = $this->faker->randomNumber(3, true);
        $email = $first_name . $last_name . $random_number . "@" . $this->faker->domainName();
        $response = $this->json("POST", route("api.register"), [
            "username" => $first_name . $last_name . $random_number,
            "email" => $email,
            "password" => "password12345",
            "v_password" => "password12345",
            "first_name" => $first_name,
            "last_name" => $last_name,
        ]);
        $response->assertStatus(200);
        $user = User::find($response['data']['data']['id']);
        $this->assertDatabaseHas('roles', [
            'slug' => 'subscriber'
        ]);
        $user->delete();
    }

    public function testRegisterWithRoleShouldCreateUserWithDefinedRole()
    {
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        $random_number = $this->faker->randomNumber(3, true);
        $email = $first_name . $last_name . $random_number . "@" . $this->faker->domainName();
        $response = $this->json("POST", route("api.register"), [
            "username" => $first_name . $last_name . $random_number,
            "email" => $email,
            "password" => "password12345",
            "v_password" => "password12345",
            "first_name" => $first_name,
            "last_name" => $last_name,
            "role" => "administrator",
        ]);
        $response->assertStatus(200);
        $user = User::find($response['data']['data']['id']);
        $this->assertDatabaseHas('roles', [
            'slug' => 'administrator'
        ]);
        $user->delete();
    }
}
