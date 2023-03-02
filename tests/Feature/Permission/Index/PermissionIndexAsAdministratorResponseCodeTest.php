<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsAdministratorResponseCodeTest extends TestCase
{
    use userTraits;

    public function testPermissionIndexAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true);
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }
}
