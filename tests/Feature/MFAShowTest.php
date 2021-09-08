<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;
use App\Models\Google2FA;
use App\Models\User;

class MFAShowTest extends TestCase
{
    /**
     * A basic feature test for show MFA.
     *
     * @return void
     */
    use userTraits, WithFaker;

    public function testMFAWithNoSessionShouldBeUnauthorized()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.mfa.qr", [$user->id]);
        $response = $this->json("GET", $url);
        $response->assertStatus(401);
        $mfa->delete();
    }

    public function testMFAAsAdministratorShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.mfa.qr", [$user->id]);
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }

    public function testMFAAsModeratorShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.mfa.qr", [$user->id]);
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }

    public function testMFAAsSubscriberShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.mfa.qr", [$user->id]);
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }
}
