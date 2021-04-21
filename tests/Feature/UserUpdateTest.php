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
        $response = $this->json("PUT", "/api/user/" . $user->id, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user->id, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {

        $user = $this->createUser("administrator");
        $response = $this->json("PUT", "/api/user/" . $user->id, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }
    
    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $response = $this->json("PUT", "/api/user/" . $user->id, [
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
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("subscriber");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->id, [
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
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->id, [
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
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->id, [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
}
