<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Media;
use Tests\Traits\userTraits;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;

class MediaStoreTest extends TestCase
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

    public function testStoreMediaAsAdministratorWithoutMfaShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
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

    public function testStoreMediaAsAdministratorWithMfaShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $filename = $this->faker->randomDigit();
        $fullFileName = $filename . ".jpg";
        $response = $this->json(
            "POST",
            route("media.store"),
            [
                "file" => UploadedFile::fake()->image($fullFileName),
                "meta" => [
                    "is_test" => true,
                ]
            ],
            $header
        );
        $response->assertStatus(200);
        Storage::disk("public")->assertExists("/media/{$fullFileName}");
        $user->delete();
    }

    public function testStoreMediaAsAdministratorWithNoOtpShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
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

    public function testStoreMediaAsAdministratorWithOtpShouldBeAllowed()
    {
        $user =  $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
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

    public function testStoreMediaAsModeratorWithoutMfaShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, false);
        $token = $this->getTokenByRole("moderator", $user->id, false);
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

    public function testStoreMediaAsModeratorWithMfaShouldBeAllowed()
    {
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
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
        $user = $this->createUser("administrator", true, false);
        $token = $this->getTokenByRole("administrator", $user->id, false);
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
