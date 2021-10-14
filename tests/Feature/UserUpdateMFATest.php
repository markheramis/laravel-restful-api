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

    #################################################################
    #                           SUBSCRIBER                          #
    #################################################################
    public function testUserUpdateMFAToSMSAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "sms",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToAuthenticatorAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToCallAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToEmailAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "email",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    #################################################################
    #                           MODERATOR                           #
    #################################################################
    public function testUserUpdateMFAToSMSAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser('moderator');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "sms",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToAuthenticatorAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser('moderator');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToCallAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser('moderator');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToEmailAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser('moderator');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "email",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }


    #################################################################
    #                           ADMIN                               #
    #################################################################
    public function testUserUpdateMFAToSMSAsAdminShouldBeAllowed()
    {
        $user = $this->createUser('admin');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "sms",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToAuthenticatorAsAdminShouldBeAllowed()
    {
        $user = $this->createUser('admin');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToCallAsAdminShouldBeAllowed()
    {
        $user = $this->createUser('admin');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "authenticator",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUserUpdateMFAToEmailAsAdminShouldBeAllowed()
    {
        $user = $this->createUser('admin');
        $token = $user->createToken(config('app.name') . ': ' . $user->username, array_keys(array_filter(array_merge(...$user->allPermissions()))))->accessToken;
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route('user.mfa.default');
        $data = [
            "default_factor" => "email",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
}
