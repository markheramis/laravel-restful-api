<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleStoreTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroyRoleWithNoUserShouldBeUnauthorized()
    {
        $response = $this->json("POST", route("role.store"), [
            "name" => "TestRole",
            "slug" => "testrole",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ]);
        $response->assertStatus(401);
    }

    public function testDestroyRoleAsSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $body = [
            "name" => "TestRoleSubscriber",
            "slug" => "testroleSubscriber",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $body, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsModeratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole("moderator");
        $body = [
            "name" => "TestRoleModerator",
            "slug" => "testroleModerator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $body, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsAdminShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $body = [
            "name" => "TestRoleAdministrator",
            "slug" => "testroleAdministrator",
            "permissions" => [
                "test.all" => true,
                "test.get" => true,
                "test.update" => true,
                "test.store" => true,
                "test.delete" => true,
            ]
        ];
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $body, $header);
        $response->assertStatus(200);
    }
}
