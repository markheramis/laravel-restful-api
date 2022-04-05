<?php

namespace Tests\Feature\Option\Update;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionUpdateResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update",
        ]);
        $response->assertStatus(401);
        $option->delete();
    }

    public function testUpdateOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update",
        ], $header);

        $response->assertStatus(200);
        $option->delete();
    }

    public function testUpdateOptionAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update 2",
        ], $header);

        $response->assertStatus(200);
        $option->delete();
    }

    public function testUpdateOptionAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update 3",
        ], $header);

        $response->assertStatus(403);
        $option->delete();
    }

    public function testUpdateOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update",
        ], $header);
        $response->assertStatus(200);
        $option->delete();
    }

    public function testUpdateOptionAsSubscriberShouldBeForbidden()
    {
        $option = Option::factory()->create();
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.update", [$option->name]);
        $response = $this->json("PUT", $url, [
            "value" => "New Update",
        ], $header);
        $response->assertStatus(403);
        $option->delete();
    }
}
