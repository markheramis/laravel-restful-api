<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Sentinel;
use Activation;
use Tests\Traits\WithUserGenerator;

class UserTest extends TestCase
{

    use WithUserGenerator;

    private $user = [];

    public function setUp(): void
    {
        parent::setUp();
        for($i=0;$i<5;$i++)
            $this->createUser('subscribers');
        for($i=0;$i<3;$i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    private function get_token(String $role_slug)
    {
      return Role::where('slug', $role_slug)
        ->first()
        ->users()
        ->inRandomOrder()
        ->first()
        ->createToken('MyApp')
        ->accessToken;
    }

    private function get_slug($role_slug)
    {
      return Role::where('slug', $role_slug)
        ->first()
        ->users()
        ->inRandomOrder()
        ->first()
        ->slug;
    }

    public function testGetAllUserAsAdminsShouldSucceed()
    {
      $token = $this->get_token('administrators');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetAllUserAsModeratorShouldSucceed()
    {
      $token = $this->get_token('moderators');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetAllUserAsSubscriberShouldSucceed()
    {
      $token = $this->get_token('subscribers');
      $expected_result = User::paginate()->toArray();
      $response = $this->json('GET', '/api/user', [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsAdministratorToAdminstratorShouldSucceed()
    {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsAdministratorToModeratorShouldSucceed()
    {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsAdministratorToSubscriberShouldSucceed()
    {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug", [] , [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToAdministratorShouldSucceed()
    {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToModeratorShouldSucceed()
    {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug" , [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsModeratorToSubscribersShouldSucceed()
    {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsSubscriberToAdministratorShouldSucceed()
    {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserAsSubscriberToModeratorShouldSucceed()
    {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetSingleUserSubscriberToSubscriberShouldSucceed()
    {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET',"/api/user/$slug", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }
}
