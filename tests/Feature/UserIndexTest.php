<?php

namespace Tests\Feature;

use Carbon\Carbon;
use App\Models\User;
use Tests\TestCase;
use Tests\Traits\userTraits;

class UserIndexTest extends TestCase
{
    use userTraits;

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

        $data = ["search" => $search];

        $expectedResult = User::whereColumn([
            ["email", "LIKE", "%$search%"],
            ["username", "LIKE", "%$search%"],
            ["first_name", "LIKE", "%$search%"],
            ["last_name", "LIKE", "%$search%"]
        ])->get();

        $data = [];

        foreach ($expectedResult as $item) {
            array_push($data, [
                "type" => null,
                "id" => $item->id,
                "attributes" => [
                    "uuid" => $item->uuid,
                    "slug" => $item->slug,
                    "email" => $item->email,
                    "role" => $item->roles()->pluck('slug'),
                    "username" => $item->username,
                    "permissions" => $item->permission,
                    "first_name" => $user->firstName,
                    "last_name" => $user->lastName,
                    "created_at" => Carbon::parse($item->created_at)->toFormattedDateString(),
                    "updated_at" => Carbon::parse($item->updated_at)->toFormattedDateString(),
                ]
            ]);
        }

        $response = $this->json("GET", route("user.index"), $data, $header);
        $response->assertStatus(200);

        $response->assertJson([
            "data" => $data
        ]);
    }
}
