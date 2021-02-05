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
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
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
    
    public function testLoginWithEmailCredentialsShouldFail()
    {
        $user = User::factory()->create();
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST', '/api/login', [
            'username' => $user->email,
            'password' => 'p@s5W0rD12347'
        ]);
        $response
        ->assertStatus(401)
        ->assertJson([
            'code' => 50004,
            'message' => 'Invalid User'
        ]);
    }

    public function testLoginWithCorrectCredentialsShouldSucceed()
    {
        $user = User::factory()->create();
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST', '/api/login', [
            'username' => $user->username,
            'password' => 'password12345'
        ]);
        $response->assertStatus(200);
    }
}
