<?php

namespace Tests\Feature\User\Register;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterActivationTest extends TestCase
{
    use WithFaker;

    public function testRegisterWithNoActivationFlagShouldCreateUnactivatedUserAccount()
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
        $activation = $user->activations->first();
        $this->assertDatabaseHas('activations', [
            'id' => $activation->id,
            'user_id' => $user->id,
            'completed' => 0,
        ]);
        $user->delete();
    }

    public function testRegisterWithFalseActivationFlagShouldCreateUnactivatedUserAccount()
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
            "activate" => false,
        ]);
        $response->assertStatus(200);
        $user = User::find($response['data']['data']['id']);
        $activation = $user->activations->first();
        $this->assertDatabaseHas('activations', [
            'id' => $activation->id,
            'user_id' => $user->id,
            'completed' => 0,
        ]);
        $user->delete();
    }

    public function testRegisterWithTrueActivationFlagShouldCreateActivatedUserAccount()
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
            "activate" => true,
        ]);
        $response->assertStatus(200);
        $user = User::find($response['data']['data']['id']);
        $activation = $user->activations->first();
        $this->assertDatabaseHas('activations', [
            'id' => $activation->id,
            'user_id' => $user->id,
            'completed' => 1,
        ]);
        $user->delete();
    }
}
