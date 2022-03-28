<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexTest extends TestCase
{
    use userTraits;

    public function testPermissionIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("permission.index"));
        $response->assertStatus(401);
    }

    public function testPermissionIndexAsAdministratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testPermissionIndexAsAdministratorWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testPermissionIndexAsModeratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, false);
        $token = $this->getTokenByRole("moderator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testPermissionIndexAsModeratorWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testPermissionIndexAsSubscribeWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("subscriber", true, false);
        $token = $this->getTokenByRole("subscriber", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testPermissionIndexAsSubscribeWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }
}
