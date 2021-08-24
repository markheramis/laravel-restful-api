<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class CategoryDeleteTest extends TestCase
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
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
        $category->delete();
    }

    public function testDestroyCategoryAsModeratorShouldBeAllowed()
    {
        $category = Category::factory()->create();
        $url = route("category.destroy", [$category->slug]);
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("DELETE", $url, [], $header);
        $response->assertStatus(200);
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
