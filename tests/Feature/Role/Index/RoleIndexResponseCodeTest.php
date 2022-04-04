<?php

namespace Tests\Feature\Role\Index;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleIndexResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetAllRolesWithNoUserShouldBeBeUnauthorized()
    {
        $response = $this->json("GET", route("role.index"));
        $response->assertStatus(401);
    }

    public function testGetAllRolesWithSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("GET", route("role.index"), [], $header);
        $response->assertStatus(403);
    }

    public function testGetAllRolesWithModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("GET", route("role.index"), [], $header);
        $response->assertStatus(200);
    }


    public function testGetAllRolesWithAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("GET", route("role.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testGetAllRolesWithAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("GET", route("role.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testGetAllRolesWithAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("GET", route("role.index"), [], $header);
        $response->assertStatus(403);
    }
}
