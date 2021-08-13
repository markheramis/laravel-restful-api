<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionStoreTest extends TestCase
{
    use WithFaker, userTraits;


    public function testStorePermissionToSubscriberWithNoSession()
    {
        $user = $this->createUser('subscriber');
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permission_subscriber_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testStorePermissionToModeratorWithNoSession()
    {
        $user = $this->createUser('moderator');
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permission_moderator_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testStorePermissionToAdministratorWithNoSession()
    {
        $user = $this->createUser("administrator");
        $response = $this->json("POST", "/api/user/{$user->id}/permission", [
            "slug" => "test_permmission_administrator_no_session",
            "value" => true
        ]);
        $response->assertStatus(401);
    }

    public function testStorePermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionsModeratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionAsModeratorToModeratorShouldShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testStorePermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testStorePermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = "/api/user/{$user2->id}/permission";
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testStorePermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = "/api/user/{$user2->id}/permission";
        $data = [
            "slug" => "test_permission",
            "value" => true
        ];
        $response = $this->json("POST", $url, $data, $header);
        $response->assertStatus(403);
    }
}
