<?php

namespace Tests\Feature\User\Store;

use Sentinel;
use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserStoreResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testStoreUserWithNoSessionShouldBeUnauthorized()
    {
        $user = User::factory()->make();
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd3321",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ]);
        $response->assertStatus(401);
    }

    public function testStoreUserAsSubscriberShouldBeForbidden()
    {
        $test_user = json_decode(config("authy.test_user"));
        $session_user = User::factory([
            'country_code' => $test_user->country_code,
            'phone_number' => $test_user->phone_number,
            'authy_id' => $test_user->authy_id,
            'authy_enabled' => 1,
            'default_factor' => 'sms',

        ])->create();
        $selectedRole = Sentinel::findRoleBySlug("subscriber");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("subscriber", $session_user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(403);
        $session_user->delete();
    }

    public function testStoreUserAsModeratorShouldBeForbidden()
    {
        $test_user = json_decode(config("authy.test_user"));
        $session_user = User::factory([
            'country_code' => $test_user->country_code,
            'phone_number' => $test_user->phone_number,
            'authy_id' => $test_user->authy_id,
            'authy_enabled' => 1,
            'default_factor' => 'sms',

        ])->create();
        $selectedRole = Sentinel::findRoleBySlug("moderator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("moderator", $session_user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(403);
        $session_user->delete();
    }

    public function testStoreUserAsAdministratorWithMfaNotVerifiedShouldBeForbidden()
    {
        $test_user = json_decode(config("authy.test_user"));
        $session_user = User::factory([
            'country_code' => $test_user->country_code,
            'phone_number' => $test_user->phone_number,
            'authy_id' => $test_user->authy_id,
            'authy_enabled' => 1,
            'default_factor' => 'sms',

        ])->create();
        $selectedRole = Sentinel::findRoleBySlug("administrator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("administrator", $session_user->id, false);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(403);
        $session_user->delete();
    }

    public function testStoreUserAsAdministratorWithMfaVerifiedShouldBeAllowed()
    {
        $test_user = json_decode(config("authy.test_user"));
        $session_user = User::factory([
            'country_code' => $test_user->country_code,
            'phone_number' => $test_user->phone_number,
            'authy_id' => $test_user->authy_id,
            'authy_enabled' => 1,
            'default_factor' => 'sms',

        ])->create();
        $selectedRole = Sentinel::findRoleBySlug("administrator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("administrator", $session_user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $user->first_name,
            "last_name" => $user->last_name,
        ], $header);
        $response->assertStatus(200);
        $session_user->delete();
    }
}
