<?php

namespace Tests\Feature\Role\Store;

use Tests\TestCase;
use App\Models\Role;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class RoleStoreResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testStoreRoleWithNoUserShouldBeUnauthorized()
    {
        $role = Role::factory()->make()->toArray();
        $response = $this->json("POST", route("role.store"), $role);
        $response->assertStatus(401);
    }

    public function testStoreRoleAsSubscriberShouldBeForbidden()
    {
        $role = Role::factory()->make()->toArray();
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(403);
    }

    public function testStoreRoleAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(403);
    }

    public function testStoreRoleAsAdminShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(200);
    }

    public function testStoreRoleAsAdminShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(200);
    }

    public function testStoreRoleAsAdminShouldBeNotAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $role = Role::factory()->make()->toArray();
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $response = $this->json("POST", route("role.store"), $role, $header);
        $response->assertStatus(403);
    }
}
