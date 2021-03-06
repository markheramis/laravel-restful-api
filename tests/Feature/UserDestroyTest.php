<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserDestroyTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroySubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscriber");
        $url = route("user.destroy", [$user->id]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
    }

    public function testDestroyModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $url = route("user.destroy", [$user->id]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
    }

    public function testDestroyAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator");
        $url = route("user.destroy", [$user->id]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
    }

    #########################################
    ############# AS SUBSCRIBER #############
    #########################################
    public function testDestroySubscriberAsSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testDestroyModeratorAsSubscriberShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
    }

    public function testDestroyAdministratorAsSubscrbierShouldBeForbidden()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    ########################################
    ############# AS MODERATOR #############
    ########################################
    public function testDestroySubscriberAsModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }
    
    public function testDestroyModeratorAsModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    public function testDestroyAdministratorAsModeratorShouldBeForbidden()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(403);
    }

    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testDestroySubscriberAsAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testDestroyModeratorAsAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }

    public function testDestroyAdministratorAsAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.destroy", [$user2->id]);
        $response = $this->json("DELETE", $url, [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
    }
}
