<?php

namespace Tests\Feature\Media\Show;

use App\Models\Media;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowAsModeratorResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;
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
}
