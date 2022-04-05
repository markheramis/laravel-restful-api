<?php

namespace Tests\Feature\Option\Show;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionShowResponseCodeTest extends TestCase
{

    use WithFaker, userTraits;

    public function testShowOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url);
        $response->assertStatus(401);
        $option->delete();
    }

    public function testShowOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $option->delete();
    }

    public function testShowOptionAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $option->delete();
    }

    public function testShowOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $option->delete();
    }

    public function testShowOptionAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $option->delete();
    }
}
