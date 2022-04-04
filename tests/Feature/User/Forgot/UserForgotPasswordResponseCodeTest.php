<?php

namespace Tests\Feature\User\Forgot;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserForgotPasswordResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testForgotPasswordWithCorrectDataSuccessfully()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.user.password.forgot"), [
            "email" => $user->email,
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testForgotPasswordEmailNotFound()
    {
        $response = $this->json("POST", route("api.user.password.forgot"), [
            "email" => $this->faker->email()
        ]);
        $response->assertStatus(404);
    }

    public function testForgotPasswordWithNoEmailShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.user.password.forgot"), []);
        $response->assertStatus(422);
    }
}
