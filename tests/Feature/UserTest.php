<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Sentinel;
use Activation;

class UserTest extends TestCase
{
    use WithFaker;

    private $user = [];

    public function setUp(): void
    {
        parent::setUp();
        $roles = Role::all();
        for ($i = 0; $i < 40; $i++) {
          $user = Sentinel::register([
            'email' => $this->faker->email(),
            'password' => 'p@s5W0rd12345',
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
          ]);
          $activation = Activation::create($user);
          #if (rand(0,1)) Activation::complete($user, $activation->code);
          Activation::complete($user, $activation->code); # activate all users
          $role_index = rand(0,count($roles) - 1);
          $roles[$role_index]->users()->attach($user);
        }
    }

    public function testAllUserAsAdmin()
    {
      $user = Role::where('slug','administrators')->first()->users()->inRandomOrder()->first();
      $token = $user->createToken('MyApp')->accessToken;

      $expected_result = User::paginate()->toArray();

      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => 'Bearer ' . $token
      ]);

      $response
      ->assertStatus(200);
    }

    public function testAllUserAsModerator()
    {
      $user = Role::where('slug','moderators')->first()->users()->inRandomOrder()->first();
      $token = $user->createToken('MyApp')->accessToken;

      $expected_result = User::paginate()->toArray();

      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => 'Bearer ' . $token
      ]);

      $response
      ->assertStatus(200);
    }

    public function testAllUserAsSubscriber()
    {
      $user = Role::where('slug','subscribers')->first()->users()->inRandomOrder()->first();
      $token = $user->createToken('MyApp')->accessToken;

      $expected_result = User::paginate()->toArray();

      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => 'Bearer ' . $token
      ]);

      $response
      ->assertStatus(403);
    }
}
