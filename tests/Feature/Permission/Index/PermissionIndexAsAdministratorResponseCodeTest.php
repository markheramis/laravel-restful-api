<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsAdministratorResponseCodeTest extends TestCase
{
    use userTraits;

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
}
