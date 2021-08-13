<?php

namespace Tests\Feature;

use Log;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserSessionTest extends TestCase
{
    use WithFaker, userTraits;


    public function testGetCurrentUserWithoutSession()
    {
        $response = $this->json("GET", '/api/me');
        $response->assertStatus(401);
    }

    public function testGetCurrentUserAsSubscriber()
    {
        $user = $this->createUser('subscriber');
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole('subscriber', $user->id);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "firstName" => $user->firstName,
                "lastName" => $user->lastName,
                "roles" => $user->roles->toArray(),
            ]
        ]);
    }

    public function testGetCurrentUserAsModerator()
    {
        $user = $this->createUser("moderator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("moderator", $user->id);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "firstName" => $user->firstName,
                "lastName" => $user->lastName,
                "roles" => $user->roles->toArray(),
            ]
        ]);
    }

    public function testGetCurrentUserAsAdministrator()
    {
        $user = $this->createUser("administrator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("administrator", $user->id);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "firstName" => $user->firstName,
                "lastName" => $user->lastName,
                "roles" => $user->roles->toArray(),
            ]
        ]);
    }
}
