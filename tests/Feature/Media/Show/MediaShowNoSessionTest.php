<?php

namespace Tests\Feature\Media\Show;

use App\Models\Media;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowNoSessionTest extends TestCase
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
}
