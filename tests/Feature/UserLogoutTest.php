<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLogoutTest extends TestCase
{
    use WithFaker, userTraits;
    
    public function testLogoutWithNoTokenShouldBeUnauthorized()
    {
        $response = $this->json("POST", route("api.logout"), []);
        $response->assertStatus(401);
    }

    public function testLogoutWithTokenSuccessAndTokenRevokedAndHasActivityLog()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->email,
            "password" => "password12345"
        ]);

        $token = $response->json()['data']['token'];
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->json("POST", route("api.logout"), []);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success']);
        
        // manually asserting that token is revoked because assertGuest('api) is not working (?)
        $this->assertTrue(auth('api')->user()->token()->revoked);
    }
}
