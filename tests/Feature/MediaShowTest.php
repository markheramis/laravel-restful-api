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
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $media = media::factory()->create();
        $url = route("media.show", [$media->id]);

        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user->delete();
        $media->delete();
    }

    public function testMediaShowWithoutMfaProtectionButNoMfaVerifiedTokenShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", true);
        $media = media::factory()->create();
        $header = [
            "Authorization" => "Bearer $token",
        ];

        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $user->delete();
        $media->delete();
    }

    public function testmediaShowAsModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole("moderator");
        $media = media::factory()->create();
        $header = [
            "Authorization" => "Bearer $token",
        ];

        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $media->delete();
    }

    public function testmediaShowAsSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole("subscriber");
        $media = media::factory()->create();
        $header = [
            "Authorization" => "Bearer $token",
        ];

        $url = route("media.show", [$media->id]);
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $media->delete();
    }
}
