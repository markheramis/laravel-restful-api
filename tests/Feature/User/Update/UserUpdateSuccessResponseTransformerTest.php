<?php

namespace Tests\Feature\User\Update;

use Sentinel;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Transformers\UserTransformer;

class UserUpdateSuccessResponseTransformerTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateSuccessResponseShouldMatchTransfomerOfUpdateUser()
    {
        $session_user = User::factory()->create();
        $selectedRole = Sentinel::findRoleBySlug("administrator");
        $selectedRole->users()->attach($session_user);
        $user = User::factory()->create();
        $update_user = User::factory()->make();
        $token = $this->getTokenByRole("administrator", $session_user->id);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $response = $this->json("PUT", route("user.update", [$user->id]), [
            "username" => $update_user->username,
            "email" => $update_user->email,
            "password" => "p@s5W0rd12345",
            "first_name" => $update_user->first_name,
            "last_name" => $update_user->last_name,
        ], $header);
        $expected_user = User::find($user->id);
        $expectedResponse = fractal($expected_user, new UserTransformer())
            ->toArray();

        $response->assertStatus(200);
        $response->assertJsonFragment($expectedResponse);
        $session_user->delete();
        $expected_user->delete();
    }
}
