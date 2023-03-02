<?php

namespace Tests\Feature\User\Store;

use Sentinel;
use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserStoreResponseCodeTest extends TestCase
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

    public function testStoreUserAsSubscriberShouldBeForbidden()
    {
        $session_user = User::factory()->create();
        $selectedRole = Sentinel::findRoleBySlug("subscriber");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("subscriber", $session_user->id);
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
        $session_user->delete();
    }

    public function testStoreUserAsModeratorShouldBeForbidden()
    {
        $session_user = User::factory()->create();
        $selectedRole = Sentinel::findRoleBySlug("moderator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("moderator", $session_user->id);
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
        $session_user->delete();
    }
}
