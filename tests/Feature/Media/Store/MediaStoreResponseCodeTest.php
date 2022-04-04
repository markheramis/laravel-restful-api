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

    /*
    public function testStoreMediaAsAdministratorShouldNotBeAllowed()
    {
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token"
        ];

        $filename = $this->faker->randomDigit();
        $fullName = $filename . '.jpg';

        $response = $this->json("POST", route("media.store"), [
            "file" => UploadedFile::fake()->image($fullName),
        ], $header);
        $response->assertStatus(403);
    }

    public function testStoreMediaAsDentistWithoutFileShouldBeUnprocessableEntity()
    {
        $user = $this->createUser("dentist", true, true);
        $token = $this->getTokenByRole("dentist", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token"
        ];

        $filename = $this->faker->randomDigit();
        $fullName = $filename . '.jpg';

        $response = $this->json("POST", route("media.store"), [
            "file" => UploadedFile::fake()->image($fullName),
        ], $header);
        $response->assertStatus(422);
    }
    */



    /*
    public function testStoreMediaAsDentistWithFileShouldBeSuccessful()
    {
        $office = Office::factory()->create();
        $user = $this->createUser("dentist", true, true);
        $user->office()->save($office);
        $token = $this->getTokenByRole("dentist", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token"
        ];
        $filename = $this->faker->randomDigit();
        $fullName = $filename . '.jpg';
        $response = $this->json("POST", route("media.store"), [
            "file" => UploadedFile::fake()->image($fullName),
            "meta" => [
                "is_test" => true,
            ]
        ], $header);
        \Log::info(json_encode($response, JSON_PRETTY_PRINT));
        $response->assertStatus(200);

        $path = "/media/$fullName";
        Storage::disk('public')->assertExists($path);

        $this->assertNotEmpty($user->worklists);
        $user->worklists()->delete();
        Storage::disk('public')->delete($path);
    }
    */
}
