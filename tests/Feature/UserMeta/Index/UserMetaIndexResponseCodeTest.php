<?php

namespace Tests\Feature\UserMeta\Index;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;

class UserMetaIndexResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testMetaIndexWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator", true, false);
        $response = $this->json("GET", route("user.meta.index", ['user' => $user->id]));
        $response->assertStatus(401);
    }

    public function testMetaIndexSelfAsAdministratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ]);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }

    public function testMetaIndexSelfAsAdministratorWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ]);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }

    public function testMetaIndexSelfAsModeratorWithoutOtpShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, false);
        $token = $this->getTokenByRole("moderator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ]);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }

    public function testMetaIndexSelfAsModeratorWithOtpShouldBeALlowed()
    {
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ]);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }

    public function testMetaIndexSelfAsSubscriberWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("subscriber", true, false);
        $token = $this->getTokenByRole("subscriber", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ], $token);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }

    public function testMetaIndexSelfAsSubscriberWithOtpShouldBeAllowed()
    {
        $user = $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $meta = $user->meta()->create([
            "meta_key" => "profile",
            "meta_value" => [
                "first_name" => $this->faker->firstName(),
                "last_name" => $this->faker->lastName(),
                "birth_date" => $this->faker->dateTime(),
            ],
            "autoload" => true,
        ], $token);
        $response = $this->json("GET", route("user.meta.index", [
            "user" => $user->id
        ]), [], $header);
        $response->assertStatus(200);
        $meta->delete();
        $user->delete();
    }
}
