<?php

namespace Tests\Feature\User\ChangePassword;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;

class UserChangePasswordResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testChangeAdministratorPasswordWithNoSessionShouldBeUnauthorized()
    {
        $url = route("user.password.change", []);
        $password = Str::random(10);
        $response = $this->json("POST", $url, [
            "password_current" => "password12345",
            "password" => $password,
            "password_confirmation" => $password,
        ], []);

        $response->assertStatus(401);
    }

    public function testChangePasswordSelfAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $url = route("user.password.change", []);
        $password = Str::random(10);
        $response = $this->json("POST", $url, [
            "password_current" => "password12345",
            "password" => $password,
            "password_confirmation" => $password,
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testChangePasswordSelfAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $url = route("user.password.change", []);
        $password = Str::random(10);
        $response = $this->json("POST", $url, [
            "password_current" => "password12345",
            "password" => $password,
            "password_confirmation" => $password,
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testChangePasswordSelfAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $url = route("user.password.change", []);
        $password = Str::random(10);
        $response = $this->json("POST", $url, [
            "password_current" => "password12345",
            "password" => $password,
            "password_confirmation" => $password,
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testChangePasswordSelfWrongCurrentPasswordShouldBeUnprocessable()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $url = route("user.password.change", []);
        $password = Str::random(10);
        $response = $this->json("POST", $url, [
            "password_current" => "password12346",
            "password" => $password,
            "password_confirmation" => $password,
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(422);
    }

    public function testChangePasswordSelfWrongCurrentPasswordConfirmationShouldBeUnprocessable()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $url = route("user.password.change", []);
        $response = $this->json("POST", $url, [
            "password_current" => "password12345",
            "password" => Str::random(10),
            "password_confirmation" => Str::random(10),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(422);
    }
}
