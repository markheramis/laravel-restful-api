<?php

namespace Tests\Feature;

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
}
