<?php

namespace Tests\Feature\User\Destroy;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserDestoryAsSubscriberResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDestroySubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscriber");
        $url = route("user.destroy", [$user->id]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
        $user->delete();
    }

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
        $user1->delete();
        $user2->delete();
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
        $user1->delete();
        $user2->delete();
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
        $user1->delete();
        $user2->delete();
    }
}
