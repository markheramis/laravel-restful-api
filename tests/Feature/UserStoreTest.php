<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserStoreTest extends TestCase
{
    use WithFaker, userTraits;

    public function testStoreUserWithNoSessionShouldBeUnauthorized()
    {
        $user = User::factory()->make();
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd3321",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ]);
        $response->assertStatus(401);
    }

    public function testStoreUserAsAdministratorShouldBeAllowed()
    {
        $user = User::factory()->make();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(200);
    }

    public function testStoreUserAsModeratorShouldBeForbidden()
    {
        $user = User::factory()->make();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(403);
    }

    public function testStoreUserAsSubscriberShouldBeForbidden()
    {
        $user = User::factory()->make();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(403);
    }
}
