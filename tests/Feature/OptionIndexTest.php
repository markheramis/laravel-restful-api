<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Option;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class OptionIndexTest extends TestCase
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
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->delete();
    }

    public function testGetOptionIndexAsModeratorShouldBeAllowed()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->delete();
    }

    public function testGetOptionIndexAsSubscriberShouldBeAllowed()
    {
        $option = Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
        $option->delete();
    }
}
