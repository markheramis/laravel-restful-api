<?php

namespace Tests\Feature;

use Log;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleShowTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetSingleRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            "name" => "TestRoleGet",
            "slug" => "testroleGet",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $url = route("role.show" , [$role->slug]);
        $response = $this->json("GET", $url, $data);
        $response->assertStatus(401);
    }

    public function testGetSingleRoleAsSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $data = [
            "name" => "TestRoleGetSubscriber",
            "slug" => "testrolegetsubscriber",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.show" , [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(403);
    }

    public function testGetSingleRoleAsModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $data = [
            "name" => "TestRoleGetModerator",
            "slug" => "testrolegetmoderator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.show" , [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(200);
    }

    public function testGetSingleRoleAsAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $data = [
            "name" => "TestRoleGetAdministrator",
            "slug" => "testrolegetadministrator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.show" , [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(200);
    }
}
