<?php

namespace Tests\Feature;

use Log;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserSessionTest extends TestCase
{
    use WithFaker, userTraits;


    public function testGetCurrentUserWithoutSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("api.me"));
        $response->assertStatus(401);
    }

    public function testGetCurrentUserAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole('subscriber', $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }

    public function testGetCurrentUserAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("moderator", $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }

    public function testGetCurrentUserAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("administrator", $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }
}
