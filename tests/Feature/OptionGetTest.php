<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionGetTest extends TestCase
{

    use WithFaker, userTraits;

    public function testGetOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $this->json("GET", "/api/option/{$option->name}")
            ->assertStatus(401);
        $option->delete();
    }

    public function testGetOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $this->json("GET", "/api/option/{$option->name}", [], [
            "Authorization" => "Bearer $token",
        ])
            ->assertStatus(200);
    }

    public function testGetOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
        $this->json("GET", "/api/option/{$option->name}", [], [
            "Authorization" => "Bearer $token",
        ])
            ->assertStatus(200);
    }

    public function testGetOptionAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $this->json("GET", "/api/option/{$option->name}", [], [
            "Authorization" => "Bearer $token",
        ])
            ->assertStatus(200);
    }
}
