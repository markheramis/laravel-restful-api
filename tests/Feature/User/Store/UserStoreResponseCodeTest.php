<?php

namespace Tests\Feature\User\Store;

use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use App\Repositories\RoleRepository;

class UserStoreResponseCodeTest extends TestCase
{

    use WithFaker,
        userTraits;

    /**
     * The role repository
     * 
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    public function setUp(): void
    {
        $this->roles = new RoleRepository();
        parent::setUp();
    }

    public function testStoreUserWithNoSessionShouldBeUnauthorized()
    {
        $user = User::factory()->make();
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd3321"
        ]);
        $response->assertStatus(401);
    }

    public function testStoreUserAsSubscriberShouldBeForbidden()
    {
        $session_user = User::factory()->create();
        $selectedRole = $this->roles->findBySlug("subscriber");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("subscriber", $session_user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345"
        ], $header);
        $response->assertStatus(403);
        $session_user->delete();
    }

    public function testStoreUserAsModeratorShouldBeForbidden()
    {
        $session_user = User::factory()->create();
        $selectedRole = $this->roles->findBySlug("moderator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("moderator", $session_user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("POST", route("user.store"), [
            "username" => $user->username,
            "email" => $user->email,
            "password" => "p@s5W0rd12345"
        ], $header);
        $response->assertStatus(403);
        $session_user->delete();
    }
}
