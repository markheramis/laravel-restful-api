<?php

namespace Tests\Feature\User\Store;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Repositories\RoleRepository;

class UserStoreSuccessResponseTransformerTest extends TestCase {

    use WithFaker,
        userTraits;

    /**
     * The role repository
     * 
     * @var \App\Repositories\RoleRepository
     */
    protected $roles;

    public function setUp(): void {
        $this->roles = new RoleRepository();
        parent::setUp();
    }

    public function testStoreSuccessResponseShouldMatchTransformedUser() {
        $session_user = User::factory()->create();
        $selectedRole = $this->roles->findBySlug("administrator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->make();
        $token = $this->getTokenByRole("administrator", $session_user->id);
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
        $created_user = User::where('username', $user->username)->first();
        $expectedResponse = fractal($created_user, new UserTransformer())->toArray();
        $response->assertStatus(200);
        $response->assertJsonFragment($expectedResponse);
        $session_user->delete();
        $created_user->delete();
    }

}
