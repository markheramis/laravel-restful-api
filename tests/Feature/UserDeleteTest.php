<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserDeleteTest extends TestCase
{
    use WithFaker, userTraits;


    public function testDeleteSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscriber");
        $response = $this->json("DELETE", "/api/user/{$user->slug}");
        $response->assertStatus(401);
    }

    public function testDeleteModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $response = $this->json("DELETE", "/api/user/{$user->slug}");
        $response->assertStatus(401);
    }

    public function testDeleteAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator");
        $response = $this->json("DELETE", "/api/user/{$user->slug}");
        $response->assertStatus(401);
    }
    #########################################
    ############# AS SUBSCRIBER #############
    #########################################
    public function testDeleteSubscriberAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $user_to_delete = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testDeleteModeratorAsSubscriberShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $user_to_delete = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testDeleteAdministratorAsSubscrbierShouldBeForbidden()
    {
        $user = $this->createUser("subscriber");
        $user_to_delete = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    ########################################
    ############# AS MODERATOR #############
    ########################################
    public function testDeleteSubscriberAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $user_to_delete = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    public function testDeleteModeratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $user_to_delete = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    public function testDeleteAdministratorAsModeratorShouldBeForbidden()
    {
        $user = $this->createUser("moderator");
        $user_to_delete = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testDeleteSubscriberAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrator");
        $user_to_delete = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteModeratorAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrator");
        $user_to_delete = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteAdministratorAsAdministratorShouldBeForbidden()
    {
        $user = $this->createUser("administrator");
        $user_to_delete = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->slug);
        $response = $this->json("DELETE", "/api/user/{$user_to_delete->slug}", [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
}
