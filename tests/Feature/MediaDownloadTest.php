<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use App\Models\Media;
use Tests\TestCase;

class MediaDownloadTest extends TestCase
{
    use userTraits, WithFaker;

    public function testDownloadMediaPublicAsAdministratorWithMfaShouldBeAllowed()
    {
        $file = $this->faker->image(storage_path("app/public/media"), 200, 200, "cats", false, true, "Faker", true);
        $path = "media/".$file;
        $media = Media::factory([
            'path' => $path,
            'status' => 'public',
        ])->create();
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);

        $url = route("media.download", [$media->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);

        $file = basename($media->path);
        // $response->assertDownload($file);
        $response->assertStatus(200);
    }

    public function testDownloadMediaPublicAsAdministratorWithNoFileExistsWithMfaShouldBeAllowed()
    {
        $media = Media::factory()->create([
            'path' => '',
            'url' => ''
        ]);
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);

        $url = route("media.download", [$media->id]);
        $response = $this->json("GET", $url, [], [
            "Authorization" => "Bearer $token"
        ]);

        $response->assertStatus(404);
    }
}
