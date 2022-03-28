<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use WithFaker;

    public function testRegisterWithNoParameterShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), []);

        $response->assertStatus(422);
    }

    public function testRegisterWithEmailOnlyShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "email" => $this->faker->email(),
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterPasswordNoVerifyShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "email"     => $this->faker->email(),
            "password"  => "password12345",
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterWithPasswordNotVerifiedShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "username"    => $this->faker->userName(),
            "email"       => $this->faker->email(),
            "password"    => "password12345",
            "v_password"  => "password123451",
        ]);
        $response->assertStatus(422);
    }

    public function testRegisterWithoutFullnameShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "username"    => $this->faker->userName(),
            "email"       => $this->faker->email(),
            "password"    => "password12345",
            "v_password"  => "password12345",
        ]);
        $response->assertStatus(422);
    }

    public function testRegisterWithNoRoleShouldBeAllowed()
    {
        $user = User::factory()->make();

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
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id'
                ]
            ]);
        User::find($response['data']['id'])->delete();
    }

    public function testRegisterWithMissingPhoneNumberShouldBeAllowed()
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
            "role" => "subscriber",
            "activate" => true,
        ]);
        $response->assertStatus(200);
        $user = User::find($response["data"]["id"]);
        $activation = $user->activations->first();
        $this->assertIsBool($activation->completed);
        $this->assertEquals(true, $activation->completed);
        $user->delete();
    }

    public function testRegisterWithCorrectParametersShouldRegisterSuccessfully()
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
            "role" => "subscriber",
            "activate" => true,
            'phone_number' => rand(1111111111, 9999999999),
            'country_code' => '1',
        ]);
        $response->assertStatus(200);
        $user = User::find($response["data"]["id"]);
        $activation = $user->activations->first();
        $this->assertIsBool($activation->completed);
        $this->assertEquals(true, $activation->completed);
        $user->delete();
    }

    public function testRegisterWithCorrectParamtersUnactivatedShouldRegisterSuccessfully()
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
            "role" => "subscriber",
            "activate" => false,
            'phone_number' => rand(1111111111, 9999999999),
            'country_code' => '1',
        ]);
        $response->assertStatus(200);
        $user = User::find($response["data"]["id"]);
        $activation = $user->activations->first();
        $this->assertIsBool($activation->completed);
        $this->assertEquals(false, $activation->completed);
        $user->delete();
    }


    public function testRegisterWithCorrectParametersAndPermissionShouldRegisterSuccessfully()
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
            "role" => "subscriber",
            "activate" => true,
            "permissions" => [
                "view.user" => true,
                "update.user" => true,
            ],
            'phone_number' => rand(1111111111, 9999999999),
            'country_code' => '1',
        ]);
        $response->assertStatus(200);
        $user = User::find($response["data"]["id"]);
        $activation = $user->activations->first();
        $this->assertIsBool($activation->completed);
        $this->assertEquals(true, $activation->completed);
        $user->delete();
    }
}
