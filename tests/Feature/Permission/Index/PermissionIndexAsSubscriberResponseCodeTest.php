<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;
use Tests\Traits\userTraits;

class PermissionIndexAsSubscriberResponseCodeTest extends TestCase
{
    use userTraits;
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
