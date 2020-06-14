<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{

    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

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
                "name" => [
                    "The name field is required."
                ],
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

    public function testWithNameOnlyError()
    {
        $response = $this->json('POST','/api/register',[
            'name' => $this->faker->firstName(),
        ]);

        $response->assertStatus(400);
    }

    public function testWithNameAndEmailOnly()
    {
        $response = $this->json('POST','/api/register',[
            'name' => $this->faker->firstName(),
            'email' => $this->faker->email(),
        ]);
        $response->assertStatus(400);
    }

    public function testPasswordNoVerify()
    {
        $response = $this->json('POST','/api/register',[
            'name'      => $this->faker->firstName(),
            'email'     => $this->faker->email(),
            'password'  => '1234567890',
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
            'name'        => $this->faker->firstName(),
            'email'       => $this->faker->email(),
            'password'    => '1234567890',
            'v_password'  => '12345678901',
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
          'name'        => $this->faker->firstName(),
          'email'       => $this->faker->email(),
          'password'    => '1234567890',
          'v_password'  => '1234567890',
      ]);
      $response
      ->assertStatus(200);
    }
}
