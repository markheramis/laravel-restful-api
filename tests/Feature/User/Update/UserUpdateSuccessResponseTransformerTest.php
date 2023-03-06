<?php

namespace Tests\Feature\User\Update;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Repositories\RoleRepository;

class UserUpdateSuccessResponseTransformerTest extends TestCase {

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

    public function testUpdateSuccessResponseShouldMatchTransfomerOfUpdateUser() {
        $session_user = User::factory()->create();
        $this->assertNotNull($session_user);
        $selectedRole = $this->roles->findBySlug("administrator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->create();
        $update_user = User::factory()->make();
        $token = $this->getTokenByRole("administrator", $session_user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $data = [
            "username" => $update_user->username,
            "email" => $update_user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $update_user->first_name,
            "last_name" => $update_user->last_name,
        ];
        $response = $this->json("PUT", route("user.update", [$user->id]), $data, $header);
        $expected_user = User::find($user->id);
        $expectedResponse = fractal($expected_user, new UserTransformer())
                ->toArray();
        $response->assertStatus(200);
        $response->assertJsonFragment($expectedResponse);
        $session_user->delete();
        $expected_user->delete();
    }

}
