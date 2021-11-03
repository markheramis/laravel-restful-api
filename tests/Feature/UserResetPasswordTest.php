<?php

namespace Tests\Feature;

use App\Models\PasswordReset;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserResetPasswordTest extends TestCase
{
    use WithFaker, userTraits;

    public function testResetPasswordWithCorrectDataSuccessfully()
    {
        $user = $this->createUser();
        $password_reset = PasswordReset::factory()->create([
            "email" => $user->email
        ]);

        $password = $this->faker->password();
        $response = $this->json("PUT", route("api.user.password.reset"), [
            "token" => $password_reset->token,
            "password" => $password,
            "confirm_password" => $password
        ]);

        $response->assertStatus(200);
        $user->delete();
        PasswordReset::whereEmail($user->email)->delete();
    }

    public function testResetPasswordNonExistentTokenNotFound()
    {
        $password = $this->faker->password();
        $response = $this->json("PUT", route("api.user.password.reset"), [
            "token" => $this->faker->bothify('?###??##'),
            "password" => $password,
            "confirm_password" => $password
        ]);

        $response->assertStatus(404);
    }

    public function testResetPasswordWithIncorrectPasswordForbidden()
    {
        $password_reset = PasswordReset::factory()->create();
        $response = $this->json("PUT", route("api.user.password.reset"), [
            "token" => $password_reset->token,
            "password" => $this->faker->password(),
            "confirm_password" => $this->faker->password()
        ]);

        $response->assertStatus(403);
        PasswordReset::whereEmail($password_reset->email)->delete();
    }

    public function testResetPasswordWithNoDataBeUnprocessableEntity()
    {
        $response = $this->json("PUT", route("api.user.password.reset"), []);
        $response->assertStatus(422);
    }
}
