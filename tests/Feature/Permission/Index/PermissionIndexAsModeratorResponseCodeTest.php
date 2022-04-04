<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsModeratorResponseCodeTest extends TestCase
{
    use userTraits;

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
}
