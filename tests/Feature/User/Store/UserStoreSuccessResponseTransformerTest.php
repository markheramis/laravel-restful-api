<?php

namespace Tests\Feature\User\Store;

use Sentinel;
use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Transformers\UserTransformer;

class UserStoreSuccessResponseTransformerTest extends TestCase
{
    use WithFaker, userTraits;

    public function testStoreSuccessResponseShouldMatchTransformedUser()
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

        $created_user = User::where('username', $user->username)->first();
        $expectedResponse = fractal($created_user, new UserTransformer())->toArray();

        $response->assertStatus(200);
        $response->assertJsonFragment($expectedResponse);
        $session_user->delete();
        $created_user->delete();
    }
}
