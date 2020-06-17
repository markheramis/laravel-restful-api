<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use WithFaker;
    
    public function testNoParameterError()
    {
        $response = $this->json('POST','/api/register',[
        ]);

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
                ],
                "v_password" => [
                    "The v password field is required."
                ]
            ]
        ], true);
    }

    public function testWithEmailOnlyError()
    {
        $response = $this->json('POST','/api/register',[
            'email' => $this->faker->email(),
        ]);

        $response->assertStatus(400);
    }

    public function testPasswordNoVerify()
    {
        $response = $this->json('POST','/api/register',[
            'email'     => $this->faker->email(),
            'password'  => 'p@s5W0rD1234',
        ]);

        $response
        ->assertStatus(400)
        ->assertJson([
            "status" => "error",
            "data" => "Validation Error.",
            "message" => [
                "v_password" => [
                    "The v password field is required."
                ]
            ]
        ], true);
    }

    public function testPasswordNotVerified()
    {
        $response = $this->json('POST','/api/register', [
            'email'       => $this->faker->email(),
            'password'    => 'p@s5W0rD1234',
            'v_password'  => 'p@s5W0rD12341',
        ]);
        $response
        ->assertStatus(400)
        ->assertJson([
            "status" => "error",
            "data" => "Validation Error.",
            "message" => [
                "v_password" => [
                    "The v password and password must match."
                ]
            ]
        ], true);
    }

    public function testCorrectRegister()
    {
        $response = $this->json('POST','/api/register', [
            'email'       => $this->faker->email(),
            'password'    => 'p@s5W0rD1234',
            'v_password'  => 'p@s5W0rD1234',
        ]);
        $response
        ->assertStatus(200);
    }

    public function testCorrectRegisterWithFullName()
    {
        $response = $this->json('POST','/api/register', [
            'email'=> $this->faker->email(),
            'password'=> 'p@s5W0rD1234',
            'v_password'=> 'p@s5W0rD1234',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
        ]);

        $response
        ->assertStatus(200);
    }

    public function testCorrectRegistrationWithPermissions()
    {
        $response = $this->json('POST','/api/register',[
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rD1234',
            'v_password' => 'p@s5W0rD1234',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'permissions' => [
                'view.user' => true,
                'update.user' => true,
            ]
        ]);
        $response
        ->assertStatus(200);
    }
}
