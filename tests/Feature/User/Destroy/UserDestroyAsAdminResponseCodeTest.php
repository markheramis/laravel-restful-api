<?php

namespace Tests\Feature\User\Destroy;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserDestroyAsAdminResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;
    public function testDestroyAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator");
        $url = route("user.destroy", [$user->id]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
        $user->delete();
    }

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
        $user1->delete();
        $user2->delete();
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
        $user1->delete();
        $user2->delete();
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
        $user1->delete();
        $user2->delete();
    }

}
