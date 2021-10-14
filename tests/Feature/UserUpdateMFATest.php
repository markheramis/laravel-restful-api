<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateMFATest extends TestCase
{
    use WithFaker, userTraits;

    public function testUserUpdateMFAWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('subscriber');
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "sms",
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }
}
