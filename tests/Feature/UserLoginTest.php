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


    public function testNoParameterError()
    {
        $response = $this->json('POST', '/api/login', []);
        $response
            ->assertStatus(422);
    }

    public function testNoPassword()
    {
        $response = $this->json('POST', '/api/login', [
            'email' => $this->faker->email(),
        ]);
        $response
            ->assertStatus(422);
    }


    public function testWrongPassword()
    {
        $user = User::factory()->create();
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST', '/api/login', [
            'email' => $user->email,
            'password' => 'p@s5W0rD12347'
        ]);
        $response
            ->assertStatus(401)
            ->assertJson([
                'code' => 50004,
                'message' => 'Invalid User'
            ]);
    }

    public function testCorrectLogin()
    {
        $user = User::factory()->create();
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST', '/api/login', [
            'email' => $user->email,
            'password' => 'password12345'
        ]);
        $response
            ->assertStatus(200);
    }
}
