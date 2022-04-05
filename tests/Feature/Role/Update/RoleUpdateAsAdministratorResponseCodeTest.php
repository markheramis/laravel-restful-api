<?php

namespace Tests\Feature\Role\Update;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Support\Str;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class RoleUpdateAsAdministratorResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateRoleAsAdministratorShouldBeAllowed()
    {
        $role = Role::factory()->create();
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.update", [$role->slug]);
        $role_name = $this->faker->jobTitle() . " " . Str::random(10);
        $role_slug = Str::slug($role_name) . "-" . Str::random(10);
        $response = $this->json("PUT", $url, [
            'name' => $role_name,
            'slug' => $role_slug,
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
        $role_name = $this->faker->jobTitle() . " " . Str::random(10);
        $role_slug = Str::slug($role_name) . "-" . Str::random(10);
        $response = $this->json("PUT", $url, [
            'name' => $role_name,
            'slug' => $role_slug,
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
        $role_name = $this->faker->jobTitle() . " " . Str::random(10);
        $role_slug = Str::slug($role_name) . "-" . Str::random(10);
        $response = $this->json("PUT", $url, [
            'name' => $role_name,
            'slug' => $role_slug,
        ], $header);
        $response->assertStatus(403);
        $role->delete();
    }
}
