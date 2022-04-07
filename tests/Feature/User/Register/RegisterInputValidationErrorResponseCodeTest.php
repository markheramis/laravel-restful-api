<?php

namespace Tests\Feature\User\Register;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterInputValidationErrorResponseCodeTest extends TestCase
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
}
