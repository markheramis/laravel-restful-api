<?php

namespace Tests\Feature\Media\Show;

use App\Models\Media;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowAsSubscriberResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

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
