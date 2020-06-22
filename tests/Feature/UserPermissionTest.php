<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Sentinel;
use Activation;

use App\Models\Role;

class UserPermissionTest extends TestCase {

    use WithFaker;

    public function setUp(): void {
        parent::setUp();
        if(env('APP_ENV') == 'testing') {
            $roles = Role::all();
            for ($i = 0; $i < 50; $i++) {
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

    public function testGetPermissionAsAdministratorToAdministrator() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToModerator() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsAdministratorToSubscriber() {
      $token = $this->get_token('administrators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToAdministrator() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToModerator() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsModeratorToSubscriber() {
      $token = $this->get_token('moderators');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(200);
    }

    public function testGetPermissionAsSubscriberToAdministratorShouldFail() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('administrators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToModeratorShouldFail() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('moderators');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(403);
    }

    public function testGetPermissionAsSubscriberToSubscriberShouldFail() {
      $token = $this->get_token('subscribers');
      $slug = $this->get_slug('subscribers');
      $response = $this->json('GET', "/api/user/$slug/permission", [], [
        'Authorization' => "Bearer $token"
      ]);
      $response
      ->assertStatus(403);
    }

    public function testAddPermissionAsAdministratorToAdministratorShouldPass() {
        $token = $this->get_token('administrators');
        $slug = $this->get_slug('administrators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToModeratorShouldPass() {
        $token = $this->get_token('administrators');
        $slug = $this->get_slug('moderators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionAsAdministratorToSubscriberShouldPass() {
        $token = $this->get_token('administrators');
        $slug = $this->get_slug('subscribers');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionsModeratorToAdministratorShouldFail() {
        $token = $this->get_token('moderators');
        $slug = $this->get_slug('administrators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToModeratorShouldFail() {
        $token = $this->get_token('moderators');
        $slug = $this->get_slug('moderators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionAsModeratorToSubscriberShouldFail() {
        $token = $this->get_token('moderators');
        $slug = $this->get_slug('subscribers');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(200);
    }

    public function testAddPermissionAsSubscriberToAdministratorShouldFail() {
        $token = $this->get_token('subscribers');
        $slug = $this->get_slug('administrators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToModeratorShouldFail() {
        $token = $this->get_token('subscribers');
        $slug = $this->get_slug('moderators');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(403);
    }

    public function testAddPermissionAsSubscriberToSubscriberShouldFail() {
        $token = $this->get_token('subscribers');
        $slug = $this->get_slug('subscribers');
        $response = $this->json('POST',"/api/user/$slug/permission",[
            'slug' => 'test_permission',
            'value' => true
        ],[
            'Authorization' => "Bearer $token"
        ]);
        $response
        ->assertStatus(403);
    }
}
