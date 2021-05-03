<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;
use App\Models\User;

class UserPermissionAddTest extends TestCase
{
    use WithFaker, userTraits;


    public function testAddPermissionToSubscriberWithNoSession()
    {
        $user = $this->createUser('subscriber');
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permission_subscriber_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionToModeratorWithNoSession()
    {
        $user = $this->createUser('moderator');
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permission_moderator_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionToAdministratorWithNoSession()
    {
        $user = $this->createUser("administrator");
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permmission_administrator_no_session",
            "value" => true
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsAdministratorToAdministratorShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsAdministratorToModeratorShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsAdministratorToSubscriberShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionsModeratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionsModeratorToAdministratorShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToModeratorShouldShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsModeratorToModeratorShouldShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsModeratorToSubscriberShouldBeAllowed\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);
    }

    public function testAddPermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsSubscriberToAdministratorShouldBeForbidden\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsSubscriberToModeratorShouldBeForbidden\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        \Log::info("testAddPermissionAsSubscriberToSubscriberShouldBeForbidden\nUrl: $url");
        $response = $this->json("POST", $url, [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(403);
    }
}
