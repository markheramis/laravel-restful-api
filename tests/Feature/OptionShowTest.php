<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionShowTest extends TestCase
{

    use WithFaker, userTraits;

    public function testShowOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url)
        $response->assertStatus(401);
        $option->delete();
    }

    public function testShowOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header)
        $response->assertStatus(200);
    }

    public function testShowOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header)
        $response->assertStatus(200);
    }

    public function testShowOptionAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.show", [$option->name]);
        $response = $this->json("GET", $url, [], $header)
        $response->assertStatus(200);
    }
}
