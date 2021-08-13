<?php

namespace Tests\Feature;


use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class RoleUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            "name" => "TestRoleUpdateNoUser",
            "slug" => "testroleupdatenouser",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $data["name"] = $data["name"] . "Updated";
        $data["slug"] = $data["name"] . "updated";
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
    }

    public function testUpdateRoleAsSubscriberShouldBeForbidden()
    {
        $data = [
            "name" => "TestRoleUpdateAsSubscriber",
            "slug" => "testroleupdateassubscriber",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $data["name"] = $data["name"] . "Updated";
        $data["slug"] = $data["slug"] . "updated";
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testUpdateRoleAsModeratorShouldBeForbidden()
    {
        $data = [
            "name" => "TestRoleUpdateAsModerator",
            "slug" => "testroleupdateasmoderator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $data["name"] = $data["name"] . "Updated";
        $data["slug"] = $data["slug"] . "updated";
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testUpdateRoleAsAdministratorShouldBeAllowed()
    {
        $data = [
            "name" => "TestRoleUpdateAsAdministrator",
            "slug" => "testroleupdateasadministrator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $data["name"] = $data["name"] . "Updated";
        $data["slug"] = $data["slug"] . "updated";
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
    }
}
