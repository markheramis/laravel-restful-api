<?php

namespace Tests\Feature\Option\Destroy;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionDestroyResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroyOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $url = route("option.destroy", [$option->name]);
        $response  = $this->json("DELETE", $url);
        $response->assertStatus(401);
        $option->delete();
    }


    public function testDestoryOptionAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $option = Option::factory()->create();

        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
    }

    public function testDestoryOptionAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator", true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
        $user->delete();
        $option->delete();
    }

    public function testDestoryOptionAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $option = Option::factory()->create();

        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $user->delete();
        $option->delete();
    }

    public function testDestoryOptionAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator", true, true);
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $option->delete();
    }

    public function testDestoryOptionAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber", true, true);
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $user->delete();
        $option->delete();
    }
}
