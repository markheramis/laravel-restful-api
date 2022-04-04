<?php

namespace Tests\Feature\Option\Index;

use Tests\TestCase;
use App\Models\Option;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class OptionIndexResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetOptionIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("option.index"));
        $response->assertStatus(401);
    }

    public function testGetOptionIndexAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->each->delete();
    }

    public function testGetOptionIndexAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->each->delete();
    }

    public function testGetOptionIndexAsAdministratorShouldBeNotAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $option = Option::factory()->count(2)->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(403);
        $option->each->delete();
    }

    public function testGetOptionIndexAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->each->delete();
    }

    public function testGetOptionIndexAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->each->delete();
    }
}
