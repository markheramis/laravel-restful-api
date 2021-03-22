<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionAddTest extends TestCase
{
    use WithFaker, userTraits;

    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser("subscriber");
        for ($i = 0; $i < 3; $i++)
            $this->createUser("moderator");
        $this->createUser("administrator");
    }

    public function testAddPermissionToSubscriberWithNoSession()
    {
        $slug = $this->getUserSlugByRoleSlug("subscrbier");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission_subscriber_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionToModeratorWithNoSession()
    {
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission_moderator_no_session",
            "value" => true,
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionToAdministratorWithNoSession()
    {
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permmission_administrator_no_session",
            "value" => true
        ]);
        $response->assertStatus(401);
    }

    public function testAddPermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionsModeratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToModeratorShouldShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("POST", "/api/user/$slug/permission", [
            "slug" => "test_permission",
            "value" => true
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
}
