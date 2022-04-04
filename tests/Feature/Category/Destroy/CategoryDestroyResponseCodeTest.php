<?php

namespace Tests\Feature\Category\Destroy;

use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class CategoryDestroyResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;


    public function testDestroyCategoryWithNoSessionShouldBeUnauthorized()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $response = $this->json("DELETE", $url);
        $response->assertStatus(401);
        $category->delete();
    }
    public function testDestroyCategoryAsAdministratorShouldBeAllowed()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
        $category->delete();
        $user->delete();
    }

    public function testDestroyCategoryAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
        $category->delete();
    }

    public function testDestroyCategoryAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $category->delete();
    }

    public function testDestroyCategoryAsModeratorShouldBeForbidden()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $category->delete();
    }

    public function testDestroyCategoryAsSubscriberShouldBeForbidden()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(403);
        $category->delete();
    }
}
