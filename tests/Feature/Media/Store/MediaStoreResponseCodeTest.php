<?php

namespace Tests\Feature\Media\Store;

use Tests\TestCase;
use App\Models\Media;
use App\Models\Office;
use Tests\Traits\userTraits;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;

class MediaStoreResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;
    public function testStoreMediaWithoutSessionShouldBeUnauthorized()
    {
        $filename = $this->faker->randomDigit();
        $fullName = $filename . '.jpg';
        $response = $this->json("POST", route("media.store"), [
            "file" => UploadedFile::fake()->image($fullName),
        ]);
        $response->assertStatus(401);
    }

    public function testStoreMediaAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true);
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $filename = $this->faker->randomDigit();
        $fillFileName = $filename . '.jpg';
        $response = $this->json(
            "POST",
            route("media.store"),
            [
                "file" => UploadedFile::fake()->image($fillFileName),
                "meta" => [
                    "is_test" => true,
                ]
            ],
            $header
        );
        $response->assertStatus(200);
        Storage::disk('public')->assertExists("/media/$fillFileName");
        $user->delete();
    }

    public function testStoreMediaAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true);
        $token = $this->getTokenByRole("moderator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $filename = $this->faker->randomDigit();
        $fillFileName = $filename . '.jpg';
        $response = $this->json(
            "POST",
            route("media.store"),
            [
                "file" => UploadedFile::fake()->image($fillFileName),
                "meta" => [
                    "is_test" => true,
                ]
            ],
            $header
        );
        $response->assertStatus(200);
        Storage::disk('public')->assertExists("/media/$fillFileName");
        $user->delete();
    }

    public function testMediaStoreShouldReturnMediaId()
    {
        $user = $this->createUser("administrator", true);
        $token = $this->getTokenByRole("administrator", $user->id);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $filename = $this->faker->randomDigit();
        $fillFileName = $filename . '.jpg';
        $response = $this->json(
            "POST",
            route("media.store"),
            [
                "file" => UploadedFile::fake()->image($fillFileName),
                "meta" => [
                    "is_test" => true,
                ]
            ],
            $header
        );
        $this->assertDatabaseHas('medias', ['id' => $response["data"]["id"]]);
        $response->assertStatus(200);
        Storage::disk('public')->assertExists("/media/$fillFileName");
        $user->delete();
    }
}
