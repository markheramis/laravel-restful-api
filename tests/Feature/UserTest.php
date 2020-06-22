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

    public function setUp(): void {
        parent::setUp();
        if(env('APP_ENV') == 'testing') {
            $roles = Role::all();
            for ($i = 0; $i < 15; $i++) {
                $user = Sentinel::register([
                    'username' => $this->faker->userName(),
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
    }

    private function get_token(String $role_slug) {
      return Role::where('slug', $role_slug)
        ->first()
        ->users()
        ->inRandomOrder()
        ->first()
        ->createToken('MyApp')
        ->accessToken;
    }

    private function get_slug($role_slug) {
      return Role::where('slug', $role_slug)
        ->first()
        ->users()
        ->inRandomOrder()
        ->first()
        ->slug;
    }

    public function testAllUserAsAdminsShouldBeFine() {
      $token = $this->get_token('administrators');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testAllUserAsModeratorShouldBeFine() {
      $token = $this->get_token('moderators');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testAllUserAsSubscriberShouldBeFine() {
      $token = $this->get_token('subscribers');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsAdministratorToAdminstrator() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsAdministratorToModerator() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsAdministratorToSubscriber() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug", [] , [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsModeratorToAdministrator() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsModeratorToModerator() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug" , [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsModeratorToSubscribers() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsSubscriberToAdministrator() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleAsSubscriberToModerator() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testSingleSubscriberToSubscriber() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET',"/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }


}
