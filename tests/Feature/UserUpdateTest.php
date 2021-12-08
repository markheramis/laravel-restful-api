<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    #####################################
    ############# AS NOBODY #############
    #####################################

    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscriber");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {

        $user = $this->createUser("administrator");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherSubscriberAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherModeratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUpdateAnotherAdministratorAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
        $user->delete();
    }
}
