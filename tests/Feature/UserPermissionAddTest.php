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
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    public function testAddPermissionAsAdministratorToAdministratorShouldBeAllowed()
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

    public function testAddPermissionAsAdministratorToModeratorShouldBeAllowed()
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

    public function testAddPermissionAsAdministratorToSubscriberShouldBeAllowed()
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

    public function testAddPermissionsModeratorToAdministratorShouldBeAllowed()
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

    public function testAddPermissionAsModeratorToModeratorShouldShouldBeAllowed()
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

    public function testAddPermissionAsModeratorToSubscriberShouldBeAllowed()
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

    public function testAddPermissionAsSubscriberToAdministratorShouldBeForbidden()
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

    public function testAddPermissionAsSubscriberToModeratorShouldBeForbidden()
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

    public function testAddPermissionAsSubscriberToSubscriberShouldBeForbidden()
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
