<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;
use App\Models\Role;

class UserPermissionTest extends TestCase
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

    public function testGetPermissionAsAdministratorToAdministrator()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToModerator()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToSubscriber()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToAdministrator()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToModerator()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToSubscriber()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetPermissionAsSubscriberToAdministratorShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToModeratorShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToSubscriberShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug/permission", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testAddPermissionAsAdministratorToAdministratorShouldPass()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToModeratorShouldPass()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToSubscriberShouldPass()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionsModeratorToAdministratorShouldFail()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToModeratorShouldFail()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToSubscriberShouldFail()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testAddPermissionAsSubscriberToAdministratorShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToModeratorShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToSubscriberShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('POST', "/api/user/$slug/permission", [
            'slug' => 'test_permission',
            'value' => true
        ], [
            'Authorization' => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
}
