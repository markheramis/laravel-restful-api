<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;

class UserUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    /*
    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }
    */
    #####################################
    ############# AS NOBODY #############
    #####################################

    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('subscribers');
        $response = $this->json('PUT', '/api/user/' . $user->uuid, [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
        ]);
        $response->assertStatus('401');
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('moderators');
        $response = $this->json('PUT', '/api/user/' . $user->uuid, [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
        ]);
        $response->assertStatus('401');
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('administraotrs');
        $response = $this->json('PUT', '/api/user/' . $user->uuid, [
            'username' => $this->faker->userName(),
            'email' => $this->faker->email(),
        ]);
        $response->assertStatus('401');
    }

    #########################################
    ############# AS SUBSCRIBER #############
    #########################################
    /*
    public function testUpdateSelfAsSubscriberShouldBeAllowed()
    {
        $user_to_update = $this->createUser('subscribers');
    }

    public function testUpdateAnotherSubscriberAsSubscriberShouldBeForbidden()
    {
    }

    public function testUpdateAnotherModeratorAsSubscriberShouldBeForbidden()
    {
    }

    public function testUpdateAnotherAdministratorAsSubscriberShouldBeForbidden()
    {
    }
    */
    ########################################
    ############# AS MODERATOR #############
    ########################################
    /*
    public function testUpdateSelfAsModeratorShouldBeAllowed()
    {
        $user_to_update = $this->createUser('moderators');
    }

    public function testUpdateAnotherSubscriberAsModeratorShouldBeForbidden()
    {
    }

    public function testUpdateAnotherModeratorAsModeratorShouldBeForbidden()
    {
    }

    public function testUpdateAnotherAdministratorAsModeratorShouldBeForbidden()
    {
    }
    */
    ############################################
    ############# AS ADMINISTRATOR #############
    ############################################
    /*
    public function testUpdateSelfAsAdministratorShouldBeAlowed()
    {
        $user_to_update = $this->createUser('administrators');
    }

    public function testUpdateAnotherSubscriberAsAdministratorShouldBeAllowed()
    {
    }

    public function testUpdateAnotherModeratorAsAdministratorShouldBeAllowed()
    {
    }
    */
    /**
     * @todo an admin shouldn't be able to edit an admin, let's change this in the future.
     * @return void
     */
    /*
    public function testUpdateAnotherAdministratorAsAdministratorShouldBeAllowed()
    {
    }
    */
}
