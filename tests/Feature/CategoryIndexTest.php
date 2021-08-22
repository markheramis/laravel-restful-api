<?php

namespace Tests\Feature;



use Tests\TestCase;
use App\Models\Category;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;


class CategoryIndexTest extends TestCase
{
    use WithFaker, userTraits;

    public function testCategoryIndexWithNoSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("category.index"));
        $response->assertStatus(401);
    }

    public function testCategoryIndexAsAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testCategoryIndexAsModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(200);
    }

    public function testCategoryIndexAsSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", route("category.index"), [], $header);
        $response->assertStatus(403);
    }
}
