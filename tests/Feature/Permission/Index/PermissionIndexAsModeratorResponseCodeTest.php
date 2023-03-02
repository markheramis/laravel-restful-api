<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsModeratorResponseCodeTest extends TestCase
{
    use userTraits;

    public function testPermissionIndexAsModeratorShouldBeAllowed()
    {
        $user =  $this->createUser("moderator", true);
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }
}
