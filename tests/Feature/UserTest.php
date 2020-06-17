<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Sentinel;
use Activation;

class UserTest extends TestCase
{
    use WithFaker;

    public function testAllUser()
    {
      # create admin user
      $user = Sentinel::register([
        'email' => 'admin@admin.com',
        'password' => 'p@s5W0rd12345',
      ]);
      $activation = Activation::create($user);
      Activation::complete($user, $activation->code);
      $role = Sentinel::findRoleBySlug('administrators');
      $role->users()->attach($user);
      $user->save();
      $token = $user->createToken('MyApp')->accessToken;

      $users = [];
      for($i = 0; $i < 5; $i++) {
        $user = Sentinel::register([
          'email' => $this->faker->email(),
          'password' => 'p@s5W0rd12345',
          'first_name' => $this->faker->firstName(),
          'last_name' => $this->faker->lastName(),
        ]);
        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);
        $users[] = $user;
      }

      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => 'Bearer ' . $token
      ]);

      $response->assertStatus(200)
      ->assertJson([
        "current_page" => 1,
        "data" => $users
      ]);
    }
}
