<?php

namespace Tests\Feature;

use Log;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserSessionTest extends TestCase
{
    use WithFaker, userTraits;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testMeAPIWithoutSession()
    {
        $response = $this->json("GET", '/api/me');
        $response->assertStatus(401);
    }

    public function testMeAPIWithASubscriber()
    {
        $user = $this->createUser('subscriber');
        $token = $this->getTokenByRole('subscriber', $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testMeAPIWithAModerator()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testMeAPIWithAnAdministrator()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }
}
