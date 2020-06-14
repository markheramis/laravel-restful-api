<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $test = $this->faker->firstName();
        $response->assertStatus(200);
    }

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
        $user = User::create($this->generateUser());
        $response = $this->json('POST','/api/login',[
            'email' => $user->email,
            'password' => '1234567'
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
        $user = User::create($this->generateUser());
        $response = $this->json('POST','/api/login',[
            'email' => $user->email,
            'password' => '123456'
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
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
            'password' => bcrypt('123456'),
        ];
    }
}
