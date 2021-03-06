<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserPermissionUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('subscriber');
        $user->addPermission('test.permission', true);
        $response  = $this->json('PUT', "/api/user/{$user->id}/permission", [
            'test.permission' => false
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('moderator');
        $user->addPermission('test.permission', true);
        $response = $this->json("PUT", "/api/user/{$user->id}/permission", [
            'test.permission' => false
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator");
        $user->addPermission('test.permission', true);
        $response = $this->json("PUT", "/api/user/{$user->id}/permission", [
            'test.permission' => false,
        ]);
        $response->assertStatus(401);
    }
}
