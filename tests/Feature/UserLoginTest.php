<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Sentinel;
use Activation;

class UserLoginTest extends TestCase
{
    use WithFaker;

    public function testLoginWithNoParameterShouldFail()
    {
        $response = $this->json('POST', '/api/login', []);
        $response
        ->assertStatus(422);
    }

    public function testLoginWithNoPasswordShouldFail()
    {
        $response = $this->json('POST', '/api/login', [
            'username' => $this->faker->userName(),
        ]);
        $response
        ->assertStatus(422);
    }

    public function testLoginWithWrongPasswordShouldFail()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/api/login', [
            'username' => $user->username,
            'password' => 'p@s5W0rD12347'
        ]);
        $response
        ->assertStatus(401)
        ->assertJson([
            'code' => 50004,
            'message' => 'Invalid User'
        ]);
    }
    
    public function testLoginWithInvalidEmailShouldFail()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/api/login', [
            'email' => 'notvalidemail',
            'password' => 'password12345',
        ]);
        $response
        ->assertStatus(422)
        ->assertJson([
            'status' => 'error',
            'data' => [
                'email' => [
                    "The email must be a valid email address."
                ]
            ],
            'message' => "Data validation failed"
        ]);
    }
    
    public function testLoginWithEmailCredentialsShouldSucceed()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/api/login', [
            'email' => $user->email,
            'password' => 'password12345'
        ]);
        $response
        #->assertStatus(200)
        ->assertJson([
            'code' => 20000
        ]);
    }

    public function testLoginWithCorrectCredentialsShouldSucceed()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/api/login', [
            'username' => $user->username,
            'password' => 'password12345'
        ]);
        $response
        ->assertStatus(200)
        ->assertJson([
            'code' => 20000
        ]);
    }
    
    public function testLoginWithCorrectCredentialsAndWithEmailAndUsernameShouldSucceed()
    {
        $user = User::factory()->create();
        $response = $this->json('POST', '/api/login', [
            'email' => $user->email,
            'username' => $user->username,
            'password' => 'password12345'
        ]);
        $response
        ->assertStatus(200)
        ->assertJson([
            'code' => 20000
        ]);
    }
}
