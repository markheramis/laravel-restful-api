<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\userTraits;

class UserIndexTest extends TestCase
{
    use userTraits;

    private $users = [];

    /**
     * test get all users as administraotr
     *
     * @todo Assert expected result array
     * @return void
     */
    public function testIndexAllUserAsAdminsShouldBeAllowed()
    {
        $user = $this->createUser('administrator');
        $token = $this->getTokenByRole("administrator", $user->id);
        # $expected_result = User::paginate()->toArray();
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test get all user as moderator
     *  
     * @todo Assert expected result array
     * @return void
     */
    public function testIndexAllUserAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser('moderator');
        $token = $this->getTokenByRole("moderator", $user->id);
        # $expected_result = User::paginate()->toArray();
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    /**
     * Test get all users as subscriber
     *
     * @todo Assert expected result array
     * @return void
     */
    public function testIndexAllUserAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $token = $this->getTokenByRole("subscriber", $user->id);
        # $expected_result = User::paginate()->toArray();
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
    }

    public function testIndexSearchAsAdministratorShouldBeAllowed()
    {
        $administrator = $this->createUser('administrator');
        $token = $administrator->createToken('MyApp')->accessToken;

        $user = $this->createUser('subscriber');
        $search = $user->email;

        $header = ["Authorization" => "Bearer $token"];
        $param = ["search" => $search];
        $response = $this->json("GET", route("user.index"), $param, $header);

        $response->assertStatus(200);

        $data = [];
        array_push($data, [
            "type" => null,
            "id" => "{$user->id}",
            "attributes" => [
                "uuid" => $user->uuid->toString(),
                "slug" => $user->slug,
                "email" => $user->email,
                "role" => $user->roles()->pluck('slug')->toArray(),
                "username" => $user->username,
                "permissions" => $user->permission,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "created_at" => Carbon::parse($user->created_at)->toFormattedDateString(),
                "updated_at" => Carbon::parse($user->updated_at)->toFormattedDateString(),
            ]
        ]);
        $response->assertJsonPath("data", $data);
    }
}
