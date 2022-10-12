<?php

namespace Tests\Feature\Role\Stats;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
class RoleStatsRoleTest extends TestCase
{
    use WithFaker, userTraits;

    public function testRoleStatsWithNoUserShouldBeUnauthorized() {
        $url = route("role.stats");
        $response = $this->json("GET", $url, []);
        $response->assertStatus(401);
    }

    public function testRoleStatsAsAdministrator() {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("role.stats");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testRoleStatsAsModerator() {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.stats");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(403);
        $user->delete();
    }

    public function testRoleStatsAsSubscriber() {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("role.stats");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(403);
        $user->delete();
    }
}
