<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateMFATest extends TestCase
{
    use WithFaker, userTraits;

    private function testValid($role, $default_factor = "sms")
    {
        $user = $this->createUser($role);
        $token = $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.mfa.default");
        $data = [
            "default_factor" => $default_factor
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

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

    #################################################################
    #                           SUBSCRIBER                          #
    #################################################################
    public function testUserUpdateMfaToSmsAsSubscriberShouldBeAllowed()
    {
        $this->testValid("subscriber", "sms");
    }

    public function testUserUpdateMfaToSmsAsAuthenticatorAsModeratorShouldBeAllowed()
    {
        $this->testValid("moderator", "sms");
    }

    public function testUserUpdateMfaToSmsAsAdministratorShouldBeAllowed()
    {
        $this->testValid("administrator", "sms");
    }

    public function testUserUpdateMfaToAuthenticatorAsSubscriberShouldBeAllowed()
    {
        $this->testValid("subscriber", "authenticator");
    }

    public function testUserUpdateMFAToAuthenticatorAsModeratorShouldBeAllowed()
    {
        $this->testValid("moderator", "authenticator");
    }

    public function testUserUpdateMfaToAuthenticatorAsAdministratorShouldBeAllowed()
    {
        $this->testValid("administrator", "authenticator");
    }

    public function testUserUpdateMfaToCallAsSubscriberShouldBeAllowed()
    {
        $this->testValid("subscriber", "call");
    }

    public function testUserUpdateMfaToCallAsModeratorShouldBeAllowed()
    {
        $this->testValid("moderator", "call");
    }

    public function testUserUpdateMfaToCallAsAdministratorShouldBeAllowed()
    {
        $this->testValid("administrator", "call");
    }

    public function testUserUpdateMfaToPushAsSubscriberShouldBeAllowed()
    {
        $this->testValid("subscriber", "push");
    }

    public function testUserUpdateMfaToPushAsModeratorShouldBeAllowed()
    {
        $this->testValid("moderator", "push");
    }

    public function testUserUpdateMfaToPushAsAdministratorShouldBeAllowed()
    {
        $this->testValid("administrator", "push");
    }
}
