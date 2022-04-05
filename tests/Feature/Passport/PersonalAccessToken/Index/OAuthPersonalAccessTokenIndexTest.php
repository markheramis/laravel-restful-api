<?php

namespace Tests\Feature\Passport\PersonalAccessToken\Index;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class OAuthPersonalAccessTokenIndexResponseCodeTest extends TestCase
{
    use userTraits, WithFaker;

    public function testGetPersonalAccessTokenWithNoSessionShouldBeUnauthorized()
    {
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url);
        $response->assertStatus(401);
    }

    public function testGetPersonalAccessTokenAsAdministratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        // $user->createToken(config('app.name') . ': ' . $user->username, $user->allPermissions())->accessToken
        $tokens = [];
        $tokenName = config('app.name') . ': ' . $user->username . '-tests-' . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }

    public function testGetPersonalAccessTokenAsAdministratorWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $tokens = [];
        $tokenName = config("app.name") . ": " . $user->username . "-tests-" . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }

    public function testGetPersonalAccessTokenAsModeratorWithoutOtpShouldBeAllowed()
    {
        $user =  $this->createUser("moderator", true, false);
        $token = $this->getTokenByRole("moderator", $user->id, false);
        $tokens = [];
        $tokenName = config("app.name") . ": " . $user->username .  "-tests-" . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }

    public function testGetPersonalAccessTokenAsModeratorWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $tokens = [];
        $tokenName = config("app.name") . ": " . $user->username .  "-tests-" . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }

    public function testGetPersonalAccessTokenAsSubscriberWithoutOtpShouldBeAllowed()
    {
        $user =  $this->createUser("subscriber", true, false);
        $token = $this->getTokenByRole("subscriber", $user->id, false);
        $tokens = [];
        $tokenName = config("app.name") . ": " . $user->username .  "-tests-" . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }

    public function testGetPersonalAccessTokenAsSubscriberWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $tokens = [];
        $tokenName = config("app.name") . ": " . $user->username .  "-tests-" . $this->faker->randomNumber();
        $tokens[] = $user->createToken($tokenName, $user->allPermissions());
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("api.passport.personal.tokens.index");
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $response->assertJsonPath("error", false);
        $user->delete();
    }
}
