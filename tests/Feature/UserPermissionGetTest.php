<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionGetTest extends TestCase
{
    use WithFaker, userTraits;

    /**
     * TEST AS ADMINISTRATOR
     */
    public function testGetPermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * TEST AS MODERATOR
     */
    public function testGetPermissionAsModeratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * TEST AS SUBSCRIBER
     */
    public function testGetPermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2  = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
}
