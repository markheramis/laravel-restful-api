<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Lcobucci\JWT\Configuration;
use Illuminate\Foundation\Testing\WithFaker;

class UserLoginTest extends TestCase
{
    use WithFaker, userTraits;

    public function testLoginWithNoParameterShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), []);
        $response->assertStatus(422);
    }

    public function testLoginWithNoPasswordShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), [
            "username" => $this->faker->userName(),
        ]);
        $response->assertStatus(422);
    }

    public function testLoginWithWrongPasswordShouldBeUnauthorized()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "p@s5W0rD12347"
        ]);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testLoginWithCorrectCredentialsShouldLoginSuccessfully()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testLoginWithCorrectCredentialsButWithEmailShouldBeAllowed()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->email,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testLoginWithCorrectCredentialsShouldLoginSuccessfullyWithToken()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertJsonStructure(['data' => ['token', 'mfa_verified']]);
        $response->assertStatus(200);
        $user->delete();
    }



    public function testLoginTokenHasMfaVerifiedClaim()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'mfa_verified']]);
        $token = $response->json()['data']['token'];

        $jwt = Configuration::forUnsecuredSigner()->parser()->parse($token);
        $mfaVerifiedClaim = $jwt->claims()->get('mfa_verified');

        /* assert our claims were set on the token */
        $this->assertEquals(false, $mfaVerifiedClaim);

        $user->delete();
    }
}
