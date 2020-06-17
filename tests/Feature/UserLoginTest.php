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
        $response = $this->json('POST', '/api/login',[]);
        $response
        ->assertStatus(400)

        ->assertJson([
            "status" => "error",
            "data" => "Validation Error.",
            "message" => [
                "email" => [
                    "The email field is required."
                ],
                "password" => [
                    "The password field is required."
                ]
            ]
        ]);
    }

    public function testNoPassword()
    {
      $response = $this->json('POST', '/api/login',[
          'email' => $this->faker->email(),
      ]);
      $response
      ->assertStatus(400)
      ->assertJson([
          "status" => "error",
          "data" => "Validation Error.",
          "message" => [
              "password" => [
                  "The password field is required."
              ]
          ]
      ]);
    }

    public function testWrongPassword()
    {
        $user = Sentinel::register($this->generateUser());
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST','/api/login',[
            'email' => $user->email,
            'password' => 'p@s5W0rD12347'
        ]);
        $response
        ->assertStatus(401)
        ->assertJson([
            "status" => "error",
            "message" => "Unauthorized access"
        ]);
    }

    public function testCorrectLogin()
    {
        $user = Sentinel::register($this->generateUser());
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $response = $this->json('POST','/api/login',[
            'email' => $user->email,
            'password' => 'p@s5W0rD1234'
        ]);
        $response
        ->assertStatus(200)
        ->assertJson([
            "status" => "success"
        ]);
    }

    private function generateUser()
    {
        return [
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rD1234',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
        ];
    }
}
