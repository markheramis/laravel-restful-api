<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Role;
use Illuminate\Support\Str;
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
            'name' => 'updated',
            'slug' => Str::slug('RoleName'),
        ]);
        $response->assertStatus(401);
        $role->delete();
    }

    public function testUpdateRoleAsSubscriberShouldBeForbidden()
    {
        $role = Role::factory()->create();
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName',
            'slug' => Str::slug('RoleName'),
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
            'name' => 'RoleName',
            'slug' => Str::slug('RoleName'),
        ], $header);
        $response->assertStatus(403);
        $role->delete();
    }

    public function testUpdateRoleAsAdministratorShouldBeAllowed()
    {
        $role = Role::factory()->create();
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName',
            'slug' => Str::slug('RoleName'),
        ], $header);
        $response->assertStatus(200);
        $role->delete();
    }

    public function testUpdateRoleAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $role = Role::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName',
            'slug' => Str::slug('RoleName'),
        ], $header);
        $response->assertStatus(200);
        $role->delete();
    }

    public function testUpdateRoleAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $role = Role::factory()->create();
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $response = $this->json("PUT", $url, [
            'name' => 'RoleName',
            'slug' => Str::slug('RoleName'),
        ], $header);
        $response->assertStatus(401);
        $role->delete();
    }
}
