<?php
namespace Tests\Unit;
use Tests\TestCase;

class PassportPersonalAccessClientEnvironmentUnitTest extends TestCase
{
    public function testConfigAndEnvironmentValueOnPersonalAccessClientIdShouldBeEquals() {
        $from_config = config('passport.personal_access_client.id');
        $this->assertTrue(isset($from_config));
    }

    public function testConfigAndEnvironmentValueOnPersonalAccessClientSecretShouldBeEquals() {
        $from_config = config('passport.personal_access_client.secret');
        $this->assertTrue(isset($from_config));
    }
}