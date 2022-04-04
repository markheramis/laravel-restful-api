<?php

namespace Tests\Feature\Option\Store;

use Tests\TestCase;
use App\Models\Option;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class OptionStoreResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;
    public function testDestroyOptionWithoutASessionShouldBeUnauthorized()
    {
        $option = Option::factory()->make();
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ]);
        $response->assertStatus(401);
    }

    public function testDestroyOptionAsAnAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $option = Option::factory()->make(['name' => 'test' . rand()]);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ], $header);

        $response->assertStatus(200);
    }

    public function testUpdateOptionAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $option = Option::factory()->make(['name' => 'test1' . rand()]);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
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
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ], $header);

        $response->assertStatus(403);
        $option->delete();
    }

    public function testDestroyOptionAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $option = Option::factory()->make();
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ], $header);
        $response->assertStatus(403);
    }

    public function testDestroyOptionAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $option = Option::factory()->make();
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ], $header);
        $response->assertStatus(403);
    }
}
