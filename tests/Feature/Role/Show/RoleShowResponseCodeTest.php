<?php

namespace Tests\Feature\Role\Show;

use Log;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleShowResponseCodeTest extends TestCase
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data);
        $response->assertStatus(401);
        $role->delete();
    }

    public function testGetSingleRoleAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(403);
        $role->delete();
    }

    public function testGetSingleRoleAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(200);
        $role->delete();
    }

    public function testGetSingleRoleAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $data = [
            "name" => "TestRoleGetAdministrator1",
            "slug" => "testrolegetadministrator1",
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(200);
        $role->delete();
    }

    public function testGetSingleRoleAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $data = [
            "name" => "TestRoleGetAdministrator2",
            "slug" => "testrolegetadministrator2",
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(200);
        $role->delete();
    }

    public function testGetSingleRoleAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $data = [
            "name" => "TestRoleGetAdministrator3",
            "slug" => "testrolegetadministrator3",
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
        $url = route("role.show", [$role->slug]);
        $response = $this->json("GET", $url, $data, $header);
        $response->assertStatus(403);
        $role->delete();
    }
}
