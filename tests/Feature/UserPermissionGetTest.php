<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionGetTest extends TestCase
{
    use WithFaker, userTraits;

    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    /**
     * TEST AS ADMINISTRATOR
     */

    public function testGetPermissionAsAdministratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * TEST AS MODERATOR
     */

    public function testGetPermissionAsModeratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * TEST AS SUBSCRIBER
     */

    public function testGetPermissionAsSubscriberToAdministratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToModeratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
}
