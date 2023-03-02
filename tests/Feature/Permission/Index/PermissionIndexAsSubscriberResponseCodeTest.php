<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsSubscriberResponseCodeTest extends TestCase
{
    use userTraits;

    public function testPermissionIndexAsSubscribeShouldBeAllowed()
    {
        $user =  $this->createUser("subscriber", true);
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("permission.index"), [], $header);
        $response->assertStatus(200);
    }
}
