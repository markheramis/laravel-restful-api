<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleDeleteTest extends TestCase
{
    use WithFaker, userTraits;

    public function testDeleteRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            'name' => 'TestRoleDelete',
            'slug' => 'testroleDelete',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $response = $this->json('DELETE', '/api/role/' . $role->slug, $data);
        $response->assertStatus(401);
    }

    public function testDeleteRoleAsSubscriberShouldBeForbidden()
    {
        $data = [
            'name' => 'TestRoleDeleteAsSubscriber',
            'slug' => 'testroleDeleteAsSubscriber',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $token = $this->getTokenByRole('subscribers');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(403);
    }

    public function testDeleteRoleAsModeratorShouldBeForbidden()
    {
        $data = [
            'name' => 'TestRoleDeleteAsModerator',
            'slug' => 'testroleDeleteAsModerator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $token = $this->getTokenByRole('moderators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(403);
    }

    public function testDeleteRoleAsAdministratorShouldBeAllowed()
    {
        $data = [
            'name' => 'TestRoleDeleteAsAdministrator',
            'slug' => 'testroleDeleteAsAdministrator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $token = $this->getTokenByRole('administrators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(200);
    }
}
