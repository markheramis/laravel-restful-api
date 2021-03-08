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

    public function testUpdateNonExistingPermissionAsSubscriberShouldBe404()
    {
    }

    public function testUpdateOwnPermissionAsSubscriberShouldBeAllowed()
    {
    }

    public function testUpdateOtherSubscriberPermissionAsSubscriberShouldBeForbidden()
    {
    }

    public function testUpdateOtherModeratorPermissionAsSubscriberShouldBeForbidden()
    {
    }

    public function testUpdateOtherAdministratorPermissionAsSubscriberShouldBeForbidden()
    {
    }

    public function updateNonExistingPermissionAsModeratorShouldBe404()
    {
    }

    public function updateOwnPermissionAsModeratorShouldBeAllowed()
    {
    }

    public function testUpdateOtherSubscriberPermissionAsModeratorShouldBeForbidden()
    {
    }

    public function testUpdateOtherModeratorPermissionAsModeratorShouldBeForbidden()
    {
    }

    public function testUpdateNonExistingPermissionAsAdministratorShouldBe404()
    {
    }

    public function testUpdateOwnPermissionAsAdministratorShouldBeAllowed()
    {
    }

    public function testUpdateOtherAdministratorPermissionAsModeratorShouldBeForbidden()
    {
    }

    public function testUpdateOtherSubscriberPermissionAsAdministratorShouldBeAllowed()
    {
    }

    public function testUpdateOtherModeratorPermissionAsAdministratorShouldBeAllowed()
    {
    }

    public function testUpdateOtherAdministratorPermissionAsAdministratorShouldBeForbidden()
    {
    }
}
