<?php

namespace Tests\Feature\User\Update;


use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    #####################################
    ############# AS NOBODY #############
    #####################################
    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("subscriber");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("moderator");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {

        $user = $this->createUser("administrator");
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data);
        $response->assertStatus(401);
        $user->delete();
    }

    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherSubscriberAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("subscriber");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherModeratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }
    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowedWhenMfaEnabledAndMfaVerified()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);
        $user->delete();
    }

    public function testUpdateAnotherAdministratorAsAdministratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $user_to_update = $this->createUser("moderator");
        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $this->faker->regexify("^[a-z0-9_-]{8,15}$"),
            "email" => $this->faker->email(),
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(403);
        $user->delete();
    }

    public function testUpdateRoleToSubscriberAsAdministrator()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $user_to_update = $this->createUser("administrator");

        $header = [
            "Authorization" => "Bearer $token",
        ];
        $url = route("user.update", [$user_to_update->id]);
        $data = [
            "username" => $user_to_update->username,
            "email" => $user_to_update->email,
            "password" => $user_to_update->password,
            "first_name" => $user_to_update->first_name,
            "last_name" => $user_to_update->last_name,
            "permissions" => $user_to_update->permissions,
            "country_code" => $user_to_update->country_code,
            "phone_number" => $user_to_update->phone_number,
            "authy_id" => $user_to_update->authy_id,
            "default_factor" => $user_to_update->default_factor,
            "role" => "subscriber",
        ];
        $response = $this->json("PUT", $url, $data, $header);
        $response->assertStatus(200);

        $updated_user = User::find($user_to_update->id);

        $hasSubscriberRole = (bool) $updated_user->roles()->where('slug', 'subscriber')->count();
        $this->assertTrue($hasSubscriberRole);
    }
}
