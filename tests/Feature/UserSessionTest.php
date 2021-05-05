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
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id" => $user->id,
                    "uuid" => $user->uuid,
                    "username" => $user->username,
                    "email" => $user->email,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "roles" => $user->roles->toArray(),
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
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
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id" => $user->id,
                    "uuid" => $user->uuid,
                    "username" => $user->username,
                    "email" => $user->email,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "roles" => $user->roles->toArray(),
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
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
        $response
            ->assertStatus(200)
            ->assertJson([
                "data" => [
                    "id" => $user->id,
                    "uuid" => $user->uuid,
                    "username" => $user->username,
                    "email" => $user->email,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "roles" => $user->roles->toArray(),
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at,
                ]
            ]);
    }
}
