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
        $token = $this->getTokenByRole("administrator");
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

    public function testUpdateOptionAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
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
        $token = $this->getTokenByRole("subscriber");
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
