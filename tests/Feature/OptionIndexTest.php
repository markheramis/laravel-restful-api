<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionIndexTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetOptionIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", "/api/option");
        $response->assertStatus(401);
    }

    public function testGetOptionIndexAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->count(5)->create([
            "autoload" => 1,
        ]);

        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this
            ->json("GET", "/api/option", [], $header)
            ->assertStatus(200);
    }

    public function testGetOptionIndexAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->count(5)->create([
            "autoload" => 1,
        ]);

        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this
            ->json("GET", "/api/option", [], $header)
            ->assertStatus(200);
    }

    public function testGetOptionIndexAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->count(5)->create([
            "autoload" => 1,
        ]);

        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this
            ->json("GET", "/api/option", [], $header)
            ->assertStatus(200);
    }
}
