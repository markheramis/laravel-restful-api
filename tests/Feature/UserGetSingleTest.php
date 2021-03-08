<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;

class UserGetSingleTest extends TestCase
{
    use userTraits;


    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    public function testGetSingleUserAsAdministratorToAdminstratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsAdministratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsAdministratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToSubscribersShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsSubscriberToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('administrators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserAsSubscriberToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('moderators');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetSingleUserSubscriberToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole('subscribers');
        $slug = $this->getUserSlugByRoleSlug('subscribers');
        $response = $this->json('GET', "/api/user/$slug", [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
}
