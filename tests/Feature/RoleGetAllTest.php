<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\userTraits;

class RoleGetAllTest extends TestCase
{
    use WithFaker, userTraits;

    public function testGetAllRolesWithNoUserShouldBeBeUnauthorized()
    {
        $response = $this->json('GET', '/api/role/');
        $response->assertStatus(401);
    }

    public function testGetAllRolesWithSubscriberShouldBeForbidden()
    {
        $token = $this->getTokenByRole('subscribers');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(403);
    }

    public function testGetAllRolesWithModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(200);
    }


    public function testGetAllRolesWithAdministratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $header = [
            'Authorization' => "Bearer $token"
        ];
        $response = $this->json('GET', '/api/role/', [], $header);
        $response->assertStatus(200);
    }
}
