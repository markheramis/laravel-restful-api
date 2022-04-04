<?php

namespace Tests\Feature\User\Show;

use Tests\TestCase;
use Tests\Traits\userTraits;

class UserShowTest extends TestCase
{
    use userTraits;

    #################################################
    ############# TEST AS ADMINISTRATOR #############
    #################################################
    public function testGetSingleUserAsAdministratorToAdminstratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsAdministratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsAdministratorToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("administrator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsAdministratorToSubscriberShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user1 = $this->createUser("administrator", true, true);
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id, true);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsAdministratorToSubscriberShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user1 = $this->createUser("administrator", true, true);
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("administrator", $user1->id, false);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user1->delete();
        $user2->delete();
    }
    #############################################
    ############# TEST AS MODERATOR #############
    #############################################
    public function testGetSingleUserAsModeratorToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsModeratorToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }
    public function testGetSingleUserAsModeratorToSubscribersShouldBeAllowed()
    {
        $user1 = $this->createUser("moderator");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("moderator", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    ##############################################
    ############# TEST AS SUBSCRIBER #############
    ##############################################
    public function testGetSingleUserAsSubscriberToAdministratorShouldBeAllowed()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("administrator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserAsSubscriberToModeratorShouldBeAllowed()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("moderator");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
    public function testGetSingleUserSubscriberToSubscriberShouldBeAllowed()
    {
        $user1 = $this->createUser("subscriber");
        $user2 = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user1->id);
        $url = route("user.show", [$user2->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $user1->delete();
        $user2->delete();
    }
}
