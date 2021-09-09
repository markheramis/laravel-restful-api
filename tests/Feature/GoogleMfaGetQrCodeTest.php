<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;
use App\Models\Google2FA;
use App\Models\User;

class GoogleMfaGetQrCodeTest extends TestCase
{
    /**
     * A basic feature test for show MFA.
     *
     * @return void
     */
    use userTraits, WithFaker;

    public function testGoogleMfaGetQrCodeWithNoSessionShouldBeUnauthorized()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.qr.google", [
            'user' => $user->id,
            'id' => $mfa->id,
        ]);
        $response = $this->json("GET", $url);
        $response->assertStatus(401);
        $mfa->delete();
    }

    public function testGoogleMfaGetQrCodeAsAdministratorShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.qr.google", [
            'user' => $user->id,
            'id' => $mfa->id,
        ]);
        $token = $this->getTokenByRole("administrator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }

    public function testGoogleMfaGetQrCodeAsModeratorShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.qr.google", [
            'user' => $user->id,
            'id' => $mfa->id,
        ]);
        $token = $this->getTokenByRole("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }

    public function testGoogleMfaGetQrCodeAsSubscriberShouldBeAllowed()
    {
        $user = User::factory()->create();
        $mfa = Google2FA::factory()->create([
            'user_id' => $user->id
        ]);
        $url = route("user.qr.google", [
            'user' => $user->id,
            'id' => $mfa->id,
        ]);
        $token = $this->getTokenByRole("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("GET", $url, [], $header);
        $response->assertStatus(200);
        $mfa->delete();
    }
}
