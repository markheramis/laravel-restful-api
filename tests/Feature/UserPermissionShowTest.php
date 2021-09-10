<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionShowTest extends TestCase
{
    use WithFaker, userTraits;

    /**
     * TEST AS ADMINISTRATOR
     */
    public function testShowPermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }

    public function testShowPermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testShowPermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }

    /**
     * TEST AS MODERATOR
     */
    public function testShowPermissionAsModeratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }

    public function testShowPermissionAsModeratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }

    public function testShowPermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }

    /**
     * TEST AS SUBSCRIBER
     */
    public function testShowPermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user1->delete();
        $user2->delete();
    }

    public function testShowPermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2  = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user1->delete();
        $user2->delete();
    }

    public function testShowPermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $response = $this->json("GET", "/api/user/{$user2->id}/permission", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user1->delete();
        $user2->delete();
    }
}
