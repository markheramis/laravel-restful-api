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
            $this->createUser("subscriber");
        for ($i = 0; $i < 3; $i++)
            $this->createUser("moderator");
        $this->createUser("administrator");
    }
    #################################################
    ############# TEST AS ADMINISTRATOR #############
    #################################################
    public function testGetSingleUserAsAdministratorToAdminstratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserAsAdministratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserAsAdministratorToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    #############################################
    ############# TEST AS MODERATOR #############
    #############################################
    public function testGetSingleUserAsModeratorToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserAsModeratorToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserAsModeratorToSubscribersShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    ##############################################
    ############# TEST AS SUBSCRIBER #############
    ##############################################
    public function testGetSingleUserAsSubscriberToAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("administrator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserAsSubscriberToModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("moderator");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
    public function testGetSingleUserSubscriberToSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole("subscriber");
        $slug = $this->getUserSlugByRoleSlug("subscriber");
        $response = $this->json("GET", "/api/user/$slug", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
}
