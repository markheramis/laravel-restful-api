<?php

namespace Tests\Feature\Category\Index;



use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;


class CategoryIndexResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testCategoryIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("category.index"));
        $response->assertStatus(401);
    }

    public function testCategoryIndexAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testCategoryIndexAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testCategoryIndexAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(403);
    }


    public function testCategoryIndexAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testCategoryIndexAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }
}
