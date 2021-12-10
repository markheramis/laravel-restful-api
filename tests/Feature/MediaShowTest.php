<?php

namespace Tests\Feature;

use App\Models\Media;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowTest extends TestCase
{
    use WithFaker, userTraits;

    public function testMediaShowWithNoSessionTestShouldBeUnauthorized() 
    {
        $media = media::factory()->create();
        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url);
        $response->assertStatus(401);
        $media->delete();
    }

    public function testMediaShowWithMfaProtectionButNoMfaVerifiedTokenShouldBeForbidden() 
    {
        $media = media::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url, [], $header);

        $response->assertStatus(403);
        $media->delete();
    }

    public function testMediaShowWithoutMfaProtectionButNoMfaVerifiedTokenShouldBeAllowed()
    {
        $media = media::factory()->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $media->delete();
    }
}
