<?php

namespace Tests\Feature;

use Log;
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
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {

        $user = $this->createUser("administrator");
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    #########################################
    ############# AS SUBSCRIBER #############
    #########################################
    public function testUpdateSelfAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateAnotherSubscriberAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $user_to_update = $this->createUser("subscriber");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }


    public function testUpdateAnotherModeratorAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherAdministratorAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $user_to_update = $this->createUser("administrator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
    ########################################
    ############# AS MODERATOR #############
    ########################################
    public function testUpdateSelfAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateAnotherSubscriberAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $user_to_update = $this->createUser("subscriber");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherModeratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherAdministratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $user_to_update = $this->createUser("administrator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateAnotherSubscriberAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $user_to_update = $this->createUser("subscriber");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateAnotherModeratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
}
