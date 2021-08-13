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
        $response = $this->json("GET", route("option.index"));
        $response->assertStatus(401);
    }

    public function testGetOptionIndexAsAdministratorShouldBeAllowed()
    {
        Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
    }
    
    public function testGetOptionIndexAsModeratorShouldBeAllowed()
    {
        Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
    }

    public function testGetOptionIndexAsSubscriberShouldBeAllowed()
    {
        Option::factory()->count(2)->create();
        $expected_response = Option::select(['name', 'value'])->where('autoload', true)->get()->toArray();
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("option.index"), [], $header);
        $response->assertStatus(200);
        $response->assertJson($expected_response);
    }
    
}
