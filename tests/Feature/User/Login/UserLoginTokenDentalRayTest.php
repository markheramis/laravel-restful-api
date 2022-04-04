<?php

namespace Tests\Feature\User\Login;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTokenDentalRayTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUserLoginAsDentistShouldReturnDentistToken()
    {
        $user = $this->createUser("dentist", true, true);
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $payload = decryptJWTToken($token);

        $dentistScopes = array_keys(Role::where('slug', 'dentist')->first()->permissions);
        $isScopeMatch = $dentistScopes == $payload['scopes'];
        $this->assertTrue($isScopeMatch);

        $accessToken = DB::table('oauth_access_tokens')->where('id', $payload['jti'])->first();
        $expiresAt = Carbon::parse($accessToken->expires_at);
        $createdAt = Carbon::parse($accessToken->created_at);

        $isExpireIn24Hours  = $expiresAt->diffInHours($createdAt) == config('passport.token_expire_in');
        $this->assertTrue($isExpireIn24Hours);

        $user->delete();
    }

    public function testUserLoginAsRadiologistShouldReturnRadiologistToken()
    {
        $user = $this->createUser("radiologist", true, true);
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $payload = decryptJWTToken($token);

        $radiologistScopes = array_keys(Role::where('slug', 'radiologist')->first()->permissions);
        $isScopeMatch = $radiologistScopes == $payload['scopes'];
        $this->assertTrue($isScopeMatch);

        $accessToken = DB::table('oauth_access_tokens')->where('id', $payload['jti'])->first();
        $expiresAt = Carbon::parse($accessToken->expires_at);
        $createdAt = Carbon::parse($accessToken->created_at);

        $isExpireIn24Hours  = $expiresAt->diffInHours($createdAt) == config('passport.token_expire_in');
        $this->assertTrue($isExpireIn24Hours);

        $user->delete();
    }
}
