<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleUpdateTest extends TestCase
{
    use WithFaker, userTraits;

    public function testUpdateRoleWithNoUserShouldBeUnauthorized()
    {
        $data = [
            'name' => 'TestRoleUpdateNoUser',
            'slug' => 'testroleupdatenouser',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $data['name'] = $data['name'] . 'Updated';
        $data['slug'] = $data['name'] . 'updated';
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data);
        $response->assertStatus(401);
    }

    public function testUpdateRoleAsSubscriberShouldBeForbidden()
    {
        $data = [
            'name' => 'TestRoleUpdateAsSubscriber',
            'slug' => 'testroleupdateassubscriber',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $data['name'] = $data['name'] . 'Updated';
        $data['slug'] = $data['slug'] . 'updated';
        $token = $this->getTokenByRole('subscribers');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(403);
    }

    public function testUpdateRoleAsModeratorShouldBeForbidden()
    {
        $data = [
            'name' => 'TestRoleUpdateAsModerator',
            'slug' => 'testroleupdateasmoderator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $data['name'] = $data['name'] . 'Updated';
        $data['slug'] = $data['slug'] . 'updated';
        $token = $this->getTokenByRole('moderators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(403);
    }

    public function testUpdateRoleAsAdministratorShouldBeAllowed()
    {
        $data = [
            'name' => 'TestRoleUpdateAsAdministrator',
            'slug' => 'testroleupdateasadministrator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $role = $this->createRole($data);
        $data['name'] = $data['name'] . 'Updated';
        $data['slug'] = $data['slug'] . 'updated';
        $token = $this->getTokenByRole('administrators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('PUT', '/api/role/' . $role->slug, $data, $header);
        $response->assertStatus(200);
    }
}
