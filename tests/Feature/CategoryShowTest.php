<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class CategoryShowTest extends TestCase
{
    use userTraits, WithFaker;

    public function testShowCategoryWithNoSessionShouldBeUnauthorized()
    {
        $category = Category::factory()->create();
        $url = route("category.show", [$category->id]);
        $response  = $this->json("GET", $url);
        $response->assertStatus(401);
    }

    public function testShowCategoryAsAdministratorShouldBeAllowed()
    {
        $category = Category::factory()->create();
        $url = route("cateogry.show", [$category->id]);
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertSttaus(200);
        $category->delete();
    }

    public function testShowCategoryAsModeratorShouldBeAllowed()
    {
        $category=Category::factory()->create();
        $url = route("category.show", [$category->id]);
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url , [] , $header);
        $response->assertStatus(200);
        $category->delete();
    }
    public function testShowCategoryAsSubscriberShouldBeAllowed()
    {
        $category = Category::factory()->create();
        $url = route("category.show", [$category->id]);
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $category->delete();
    }
}
