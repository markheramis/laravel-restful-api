<?php

namespace Tests\Feature\Passport\PersonalAccessToken\Store;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class OAuthPersonalAccessTokenStoreResponseCodeTest extends TestCase
{
    use userTraits, WithFaker;

    public function testStorePersonalAccessTokenWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator", true);
        $config = config('permissions');
        $scopes = $this->faker->randomElements($config, $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ]);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsAdministratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsAdministratorWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsModeratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, false);
        $token = $this->getTokenByRole("moderator", $user->id, false);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsModeratorWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsSubscriberWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("subscriber", true, false);
        $token = $this->getTokenByRole("subscriber", $user->id, false);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testStorePersonalAccessTokenAsSubscriberWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $config = config("permissions");
        $scopes = $this->faker->randomElements(array_keys($config), $this->faker->numberBetween(1, count($config)));
        $tokenName = config("app.name") . ": " . $user->username . "-patstore-test-" . $this->faker->randomNumber();
        $url = route("api.passport.personal.tokens.store");
        $response = $this->json("POST", $url, [
            "name" => $tokenName,
            "scopes" => $scopes
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }
}
