<?php

namespace Tests\Feature\Permission\Index;

use Tests\TestCase;

class PermissionIndexAsNoSessionResponseCodeTest extends TestCase
{
    public function testPermissionIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("permission.index"));
        $response->assertStatus(401);
    }
}
