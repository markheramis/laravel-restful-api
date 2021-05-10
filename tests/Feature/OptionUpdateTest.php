<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();
        $response = $this->json("PUT", "/api/option/{$option->name}", [
            "value" => "New Update",
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("PUT", "/api/option/{$option->name}", [
            "value" => "New Update",
        ], $header);

        $response->assertStatus(200);
    }

    public function testUpdateOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("PUT", "/api/option/{$option->name}", [
            "value" => "New Update",
        ], $header);
        $response->assertStatus(200);
    }

    public function testUpdateOptionAsModeratorShouldBeForbidden()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("PUT", "/api/option/{$option->name}", [
            "value" => "New Update",
        ], $header);
        $response->assertStatus(403);
    }
}
