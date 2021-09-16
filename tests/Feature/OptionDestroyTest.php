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
        $url = route("option.destroy", [$option->name]);
        $response  = $this->json("DELETE", $url);
        $response->assertStatus(401);
        $option->delete();
    }


    public function testDestoryOptionAsAdministratorShouldBeAllowed()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
    }

    public function testDestoryOptionAsModeratorShouldBeForbidden()
    {
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("moderator");
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
        $option = Option::factory()->create();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("option.destroy", [$option->name]);
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $option->delete();
    }
}
