<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleDestroyTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroyRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            "name" => "TestRoleDelete",
            "slug" => "testroleDelete",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $url = route("role.update", [$role->slug]);
        $response = $this->json("DELETE", $url, $data);
        $response->assertStatus(401);
    }

    public function testDestroyRoleAsSubscriberShouldBeForbidden()
    {
        $data = [
            "name" => "TestRoleDeleteAsSubscriber",
            "slug" => "testroleDeleteAsSubscriber",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsModeratorShouldBeForbidden()
    {
        $data = [
            "name" => "TestRoleDeleteAsModerator",
            "slug" => "testroleDeleteAsModerator",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsAdministratorShouldBeAllowed()
    {
        $data = [
            "name" => "TestRoleDeleteAsAdministrator",
            "slug" => "testroleDeleteAsAdministrator",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testDestroyRoleAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $data = [
            "name" => "TestRoleDeleteAsAdministrator1",
            "slug" => "testroleDeleteAsAdministrator1",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testDestroyRoleAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $data = [
            "name" => "TestRoleDeleteAsAdministrator2",
            "slug" => "testroleDeleteAsAdministrator2",
            "permissions" => [
                "test.index" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(401);
    }
}
