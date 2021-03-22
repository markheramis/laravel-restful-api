<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;
use Tests\TestCase;

class UserPermissionUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    public function testUpdateSubscriberWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser('subscriber');
          
    }

    public function testUpdateModeratorWithNoSessionShouldBeUnauthorized()
    {
    }

    public function testUpdateAdministratorWithNoSessionShouldBeUnauthorized()
    {
    }
}
