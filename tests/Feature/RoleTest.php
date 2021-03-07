<?php

namespace Tests\Feature;

use Sentinel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Models\Role;

class RoleTest extends TestCase
{

    use WithFaker, userTraits;

    public function testGetAllRolesWithNoUserShouldFail()
    {
        $response = $this->json('GET', '/api/role/');
        $response->assertStatus(401);
    }

    public function testGetAllRolesWithSubscriberShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(403);
    }

    public function testGetAllRolesWithModeratorShouldSucceed()
    {
        $token = $this->getTokenByRole('moderators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(200);
    }

    public function testGetAllRolesWithAdministratorShouldSucceed()
    {
        $token = $this->getTokenByRole('administrators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(200);
    }

    public function testGetSingleWithNoUserShouldFail()
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

    public function testGetSingleAsSubscriberShouldFail()
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

    public function testGetSingleAsModeratorShouldFail()
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

    public function testGetSingleAsAdministratorShouldSucceed()
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

    public function testCreateRoleWithNoUserShouldFail()
    {
        $response = $this->json('POST', '/api/role/', [
            'name' => 'TestRole',
            'slug' => 'testrole',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ]);
        $response->assertStatus(401);
    }

    public function testCreateRoleAsSubscriberShouldFail()
    {
        $token = $this->getTokenByRole('subscribers');
        $body = [
            'name' => 'TestRoleSubscriber',
            'slug' => 'testroleSubscriber',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('POST', '/api/role/', $body, $header);
        $response->assertStatus(403);
    }

    public function testCreateRoleAsModeratorShouldFail()
    {
        $token = $this->getTokenByRole('moderators');
        $body = [
            'name' => 'TestRoleModerator',
            'slug' => 'testroleModerator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('POST', '/api/role/', $body, $header);
        $response->assertStatus(403);
    }

    public function testCreateRoleAsAdminShouldSucceed()
    {
        $token = $this->getTokenByRole('administrators');
        $body = [
            'name' => 'TestRoleAdministrator',
            'slug' => 'testroleAdministrator',
            'permissions' => [
                'test.all' => true,
                'test.get' => true,
                'test.update' => true,
                'test.store' => true,
                'test.delete' => true,
            ]
        ];
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('POST', '/api/role/', $body, $header);
        $response->assertStatus(200);
    }

    public function testUpdateRoleWithNoNoUserShouldFail()
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

    public function testUpdateRoleAsSubscriberShouldFail()
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

    public function testUpdateRoleAsModeratorShouldFail()
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

    public function testUpdateRoleAsAdministratorShouldSucceed()
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

    public function testDeleteRoleWithNoUser()
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

    public function testDeleteRoleAsSubscriberShouldFail()
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

    public function testDeleteRoleAsModeratorShouldFail()
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

    public function testDeleteRoleAsAdministratorShouldSucceed()
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
