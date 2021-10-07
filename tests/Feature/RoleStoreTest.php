<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class RoleStoreTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroyRoleWithNoUserShouldBeUnauthorized()
    {
        $role = Role::factory()->make()->toArray();
        $response = $this->json("POST", route("role.store"), $role);
        $response->assertStatus(401);
    }

    public function testDestroyRoleAsSubscriberShouldBeForbidden()
    {
        $role = Role::factory()->make()->toArray();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsModeratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole("moderator");
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(403);
    }

    public function testDestroyRoleAsAdminShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(200);
    }
}
