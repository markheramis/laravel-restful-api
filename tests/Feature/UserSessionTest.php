<?php

namespace Tests\Feature;

use Log;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserSessionTest extends TestCase
{
    use WithFaker, userTraits;


    public function testGetCurrentUserWithoutSession()
    {
        $response = $this->json("GET", '/api/me');
        $response->assertStatus(401);
    }

    public function testGetCurrentUserAsSubscriber()
    {
        $user = $this->createUser('subscriber');
        $token = $this->getTokenByRole('subscriber', $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testGetCurrentUserAsModerator()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testGetCurrentUserAsAdministrator()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("GET", "/api/me", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }
}
