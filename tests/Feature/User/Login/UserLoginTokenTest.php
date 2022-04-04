<?php

namespace Tests\Feature\User\Login;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTokenTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUserLoginAsAdministratorShouldReturnAdministratorToken()
    {
        $user = $this->createUser("administrator", true, true);
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $payload = decryptJWTToken($token);

        $adminScopes = array_keys(Role::where('slug', 'administrator')->first()->permissions);
        $isScopeMatch = $adminScopes == $payload['scopes'];
        $this->assertTrue($isScopeMatch);

        $accessToken = DB::table('oauth_access_tokens')->where('id', $payload['jti'])->first();
        $expiresAt = Carbon::parse($accessToken->expires_at);
        $createdAt = Carbon::parse($accessToken->created_at);

        $isExpireIn24Hours  = $expiresAt->diffInHours($createdAt) == config('passport.token_expire_in');
        $this->assertTrue($isExpireIn24Hours);

        $user->delete();
    }

    public function testUserLoginAsModeratorShouldReturnModeratorToken()
    {
        $user = $this->createUser("moderator", true, true);
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $payload = decryptJWTToken($token);

        $moderatorScopes = array_keys(Role::where('slug', 'moderator')->first()->permissions);
        $isScopeMatch = $moderatorScopes == $payload['scopes'];
        $this->assertTrue($isScopeMatch);

        $accessToken = DB::table('oauth_access_tokens')->where('id', $payload['jti'])->first();
        $expiresAt = Carbon::parse($accessToken->expires_at);
        $createdAt = Carbon::parse($accessToken->created_at);

        $isExpireIn24Hours  = $expiresAt->diffInHours($createdAt) == config('passport.token_expire_in');
        $this->assertTrue($isExpireIn24Hours);

        $user->delete();
    }

    public function testUserLoginAsSubscriberShouldReturnSubscriberToken()
    {
        $user = $this->createUser("subscriber", true, true);
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $payload = decryptJWTToken($token);

        $subscriberScopes = array_keys(Role::where('slug', 'subscriber')->first()->permissions);
        $isScopeMatch = $subscriberScopes == $payload['scopes'];
        $this->assertTrue($isScopeMatch);

        $accessToken = DB::table('oauth_access_tokens')->where('id', $payload['jti'])->first();
        $expiresAt = Carbon::parse($accessToken->expires_at);
        $createdAt = Carbon::parse($accessToken->created_at);

        $isExpireIn24Hours  = $expiresAt->diffInHours($createdAt) == config('passport.token_expire_in');
        $this->assertTrue($isExpireIn24Hours);

        $user->delete();
    }
}
