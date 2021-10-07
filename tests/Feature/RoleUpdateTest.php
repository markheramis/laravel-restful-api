<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Role;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class RoleUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateRoleWithNoUserShouldBeUnauthorized()
    {
        $role = Role::factory()->create();
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'updated'
        ]);
        $response->assertStatus(401);
        $role->delete();
    }

    public function testUpdateRoleAsSubscriberShouldBeForbidden()
    {
        $role = Role::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName'
        ], $header);
        $response->assertStatus(403);
        $role->delete();
    }

    public function testUpdateRoleAsModeratorShouldBeForbidden()
    {
        $role = Role::factory()->create();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName'
        ], $header);
        $response->assertStatus(403);
        $role->delete();
    }

    public function testUpdateRoleAsAdministratorShouldBeAllowed()
    {
        $role = Role::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName'
        ], $header);
        $response->assertStatus(200);

        $role->delete();
    }
}
