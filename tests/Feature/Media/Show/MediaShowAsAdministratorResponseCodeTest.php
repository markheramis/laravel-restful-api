<?php

namespace Tests\Feature\Media\Show;

use App\Models\Media;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class MediaShowAsAdministratorResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

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
}
