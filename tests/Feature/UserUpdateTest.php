<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    /*
    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser("subscribers");
        for ($i = 0; $i < 3; $i++)
            $this->createUser("moderators");
        $this->createUser("administrators");
    }
    */
    #####################################
    ############# AS NOBODY #############
    #####################################

    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscribers");
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderators");
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrators");
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ]);
        $response->assertStatus(401);
    }

    #########################################
    ############# AS SUBSCRIBER #############
    #########################################

    public function testUpdateSelfAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser("subscribers");
        $token = $this->getTokenByRole('subscribers', $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateAnotherSubscriberAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscribers");
        $token = $this->getTokenByRole("subscribers", $user->slug);
        $user_to_update = $this->createUser("subscribers");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherModeratorAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscribers");
        $token = $this->getTokenByRole("subscribers", $user->slug);
        $user_to_update = $this->createUser("moderators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherAdministratorAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscribers");
        $token = $this->getTokenByRole("subscribers", $user->slug);
        $user_to_update = $this->createUser("administrators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }
    ########################################
    ############# AS MODERATOR #############
    ########################################
    /*
    public function testUpdateSelfAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderators");
        $token = $this->getTokenByRole("moderators", $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);

        $response->assertStatus(200);
    }

    public function testUpdateAnotherSubscriberAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderators");
        $token = $this->getTokenByRole("moderators", $user->slug);
        $user_to_update = $this->createUser("subscribers");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherModeratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderators");
        $token = $this->getTokenByRole("moderators", $user->slug);
        $user_to_update = $this->createUser("moderators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    public function testUpdateAnotherAdministratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderators");
        $token = $this->getTokenByRole("moderators", $user->slug);
        $user_to_update = $this->createUser("administrators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    */
    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    /*
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user = $this->createUser("administrators");
        $token = $this->getTokenByRole("administrators", $user->slug);
        $response = $this->json("PUT", "/api/user/" . $user->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
    */
    /**
     * 
     * @todo Administrators should be able to edit Subscribers
     * @return void
     */
    /*
    public function testUpdateAnotherSubscriberAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrators");
        $token = $this->getTokenByRole("administrators", $user->slug);
        $user_to_update = $this->createUser("subscribers");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    */
    /**
     * @todo Administrators should be able to edit Moderators user details
     * @return void
     */
    /*
    public function testUpdateAnotherModeratorAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrators");
        $token = $this->getTokenByRole("administrators", $user->slug);
        $user_to_update = $this->createUser("moderators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    */
    /**
     * @todo an admin shouldn"t be able to edit an admin, let"s change this in the future.
     * @return void
     */
    /*
    public function testUpdateAnotherAdministratorAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrators");
        $token = $this->getTokenByRole("administrators", $user->slug);
        $user_to_update = $this->createUser("moderators");
        $response = $this->json("PUT", "/api/user/" . $user_to_update->slug, [
            "username" => $this->faker->userName(),
            "email" => $this->faker->email(),
        ], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    */
}
