<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;

class UserLoginTest extends TestCase
{
    use WithFaker, userTraits;

    public function testLoginWithNoParameterShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), []);
        $response->assertStatus(422);
    }

    public function testLoginWithNoPasswordShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), [
            "username" => $this->faker->userName(),
        ]);
        $response->assertStatus(422);
    }

    public function testLoginWithWrongPasswordShouldBeUnauthorized()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "p@s5W0rD12347"
        ]);
        $response->assertStatus(401);
    }

    public function testLoginWithInvalidEmailShouldBeUnprocessableEntity()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "email" => "notvalidemail",
            "password" => "password12345",
        ]);
        $response->assertStatus(422);
        $response->assertJson([
            "status" => "error",
            "data" => [
                "email" => [
                    "The email must be a valid email address."
                ]
            ],
            "message" => "Data validation failed"
        ]);
    }

    public function testLoginWithEmailCredentialsShouldLoginSuccessfully()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "email" => $user->email,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
    }

    public function testLoginWithCorrectCredentialsShouldLoginSuccessfully()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
    }

    public function testLoginWithCorrectCredentialsAndWithEmailAndUsernameShouldLoginSuccessfully()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "email" => $user->email,
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
    }
}
