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
            "password"  => "p@s5W0rD1234",
        ]);

        $response->assertStatus(422);
    }

    public function testRegisterWithPasswordNotVerifiedShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "username"    => $this->faker->userName(),
            "email"       => $this->faker->email(),
            "password"    => "p@s5W0rD1234",
            "v_password"  => "p@s5W0rD12341",
        ]);
        $response->assertStatus(422);
    }

    public function testRegisterWithoutFullnameShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.register"), [
            "username"    => $this->faker->userName(),
            "email"       => $this->faker->email(),
            "password"    => "p@s5W0rD1234",
            "v_password"  => "p@s5W0rD1234",
        ]);
        $response->assertStatus(422);
    }

    public function testRegisterWithNoRoleShouldBeAllowed()
    {
        $response = $this->json("POST", route("api.register"), [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
            "password" => "p@s5W0rD1234",
            "v_password" => "p@s5W0rD1234",
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "activate" => false,
        ]);

        $response->assertStatus(200);
    }

    public function testRegisterWithMissingPhoneNumberShouldBeAllowed()
    {
        $response = $this->json("POST", route("api.register"), [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
            "password" => "p@s5W0rD1234",
            "v_password" => "p@s5W0rD1234",
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
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
        $response = $this->json("POST", route("api.register"), [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
            "password" => "p@s5W0rD1234",
            "v_password" => "p@s5W0rD1234",
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "role" => "subscriber",
            "activate" => true,
            "phone_number" => rand(1111111111, 9999999999),
            "country_code" => "1",
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
        $response = $this->json("POST", route("api.register"), [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
            "password" => "p@s5w0rd1234",
            "v_password" => "p@s5w0rd1234",
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "role" => "subscriber",
            "activate" => false,
            "phone_number" => rand(1111111111, 9999999999),
            "country_code" => "1",
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
        $response = $this->json("POST", route("api.register"), [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
            "password" => "p@s5W0rD1234",
            "v_password" => "p@s5W0rD1234",
            "first_name" => $this->faker->firstName(),
            "last_name" => $this->faker->lastName(),
            "role" => "subscriber",
            "activate" => true,
            "permissions" => [
                "view.user" => true,
                "update.user" => true,
            ],
            "phone_number" => rand(1111111111, 9999999999),
            "country_code" => "1",
        ]);
        $response->assertStatus(200);
        $user = User::find($response["data"]["id"]);
        $activation = $user->activations->first();
        $this->assertIsBool($activation->completed);
        $this->assertEquals(true, $activation->completed);
        $user->delete();
    }
}
