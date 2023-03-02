<?php

namespace Tests\Feature\Media\Show;

use App\Models\Media;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowAsAdministratorResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testMediaAsAdministratorShouldBeAllowed() {
        $user = $this->createUser("administrator", true);
        $token = $this->getTokenByRole("administrator", $user->id);
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
}
