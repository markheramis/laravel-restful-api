<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleGetSingleTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetSingleRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            'name' => 'TestRoleGet',
            'slug' => 'testroleGet',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $response = $this->json('GET', '/api/role/' . $role->slug, $data);
        $response->assertStatus(401);
    }

    public function testGetSingleRoleAsSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole('subscribers');
        $data = [
            'name' => 'TestRoleGetSubscriber',
            'slug' => 'testrolegetsubscriber',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(403);
    }

    public function testGetSingleRoleAsModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $data = [
            'name' => 'TestRoleGetModerator',
            'slug' => 'testrolegetmoderator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(200);
    }

    public function testGetSingleRoleAsAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $data = [
            'name' => 'TestRoleGetAdministrator',
            'slug' => 'testrolegetadministrator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(200);
    }
}
