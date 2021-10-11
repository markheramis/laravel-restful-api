<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Option;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class OptionStoreTest extends TestCase
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
        $token = $this->getTokenByRole("administrator");
        $option = Option::factory()->make();
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("option.store"), [
            "name" => $option->name,
            "value" => $option->value,
        ], $header);

        $response->assertStatus(200);
    }

    public function testDestroyOptionAsModeratorShouldBeForbidden()
    {
        $token = $this->getTokenByRole("moderator");
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
        $token = $this->getTokenByRole("subscriber");
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
