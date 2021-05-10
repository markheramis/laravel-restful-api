<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Option;

class OptionDestroyTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroyOptionWithNoSessionShouldBeUnauthorized()
    {
        $option = Option::factory()->create();

        $response  = $this->json("DELETE", "/api/option/{$option->name}");
        $response->assertStatus(401);
    }


    public function testDestoryOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", "/api/option/{$option->name}", [], $header);
        $response->assertStatus(200);
    }

    public function testDestoryOptionAsModeratorShouldBeForbidden()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", "/api/option/{$option->name}", [], $header);
        $response->assertStatus(403);
    }

    public function testDestoryOptionAsSubscriberShouldBeForbidden()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", "/api/option/{$option->name}", [], $header);
        $response->assertStatus(403);
    }
}
