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
        $token = $this->getTokenByRole("subscriber");
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
        $token = $this->getTokenByRole("moderator");
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
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
    }
}
