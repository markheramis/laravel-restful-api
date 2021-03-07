<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Sentinel;
use Activation;
use Tests\Traits\userTraits;

class UserTest extends TestCase
{

  use userTraits;

  private $user = [];

  public function setUp(): void
  {
    parent::setUp();
    for ($i = 0; $i < 5; $i++)
      $this->createUser('subscribers');
    for ($i = 0; $i < 3; $i++)
      $this->createUser('moderators');
    $this->createUser('administrators');
  }

  public function testGetAllUserAsAdminsShouldSucceed()
  {
    $token = $this->getTokenByRole('administrators');
    $expected_result = User::paginate()->toArray();
    $response = $this->json('GET', '/api/user', [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetAllUserAsModeratorShouldSucceed()
  {
    $token = $this->getTokenByRole('moderators');
    $expected_result = User::paginate()->toArray();
    $response = $this->json('GET', '/api/user', [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetAllUserAsSubscriberShouldSucceed()
  {
    $token = $this->getTokenByRole('subscribers');
    $expected_result = User::paginate()->toArray();
    $response = $this->json('GET', '/api/user', [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsAdministratorToAdminstratorShouldSucceed()
  {
    $token = $this->getTokenByRole('administrators');
    $slug = $this->getUserSlugByRoleSlug('administrators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsAdministratorToModeratorShouldSucceed()
  {
    $token = $this->getTokenByRole('administrators');
    $slug = $this->getUserSlugByRoleSlug('moderators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsAdministratorToSubscriberShouldSucceed()
  {
    $token = $this->getTokenByRole('administrators');
    $slug = $this->getUserSlugByRoleSlug('subscribers');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsModeratorToAdministratorShouldSucceed()
  {
    $token = $this->getTokenByRole('moderators');
    $slug = $this->getUserSlugByRoleSlug('administrators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsModeratorToModeratorShouldSucceed()
  {
    $token = $this->getTokenByRole('moderators');
    $slug = $this->getUserSlugByRoleSlug('moderators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsModeratorToSubscribersShouldSucceed()
  {
    $token = $this->getTokenByRole('moderators');
    $slug = $this->getUserSlugByRoleSlug('subscribers');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsSubscriberToAdministratorShouldSucceed()
  {
    $token = $this->getTokenByRole('subscribers');
    $slug = $this->getUserSlugByRoleSlug('administrators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserAsSubscriberToModeratorShouldSucceed()
  {
    $token = $this->getTokenByRole('subscribers');
    $slug = $this->getUserSlugByRoleSlug('moderators');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }

  public function testGetSingleUserSubscriberToSubscriberShouldSucceed()
  {
    $token = $this->getTokenByRole('subscribers');
    $slug = $this->getUserSlugByRoleSlug('subscribers');
    $response = $this->json('GET', "/api/user/$slug", [], [
      'Authorization' => "Bearer $token"
    ]);
    $response
      ->assertStatus(200);
  }
}
