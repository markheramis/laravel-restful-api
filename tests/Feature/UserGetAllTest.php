<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\userTraits;

class UserGetAllTest extends TestCase
{
    use userTraits;

    public function setUp(): void
    {
        parent::setUp();
        for ($i = 0; $i < 5; $i++)
            $this->createUser('subscribers');
        for ($i = 0; $i < 3; $i++)
            $this->createUser('moderators');
        $this->createUser('administrators');
    }

    public function testGetAllUserAsAdminsShouldBeAllowed()
    {
        $token = $this->getTokenByRole('administrators');
        $expected_result = User::paginate()->toArray();
        $response = $this->json('GET', '/api/user', [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetAllUserAsModeratorShouldBeAllowed()
    {
        $token = $this->getTokenByRole('moderators');
        $expected_result = User::paginate()->toArray();
        $response = $this->json('GET', '/api/user', [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }

    public function testGetAllUserAsSubscriberShouldBeAllowed()
    {
        $token = $this->getTokenByRole('subscribers');
        $expected_result = User::paginate()->toArray();
        $response = $this->json('GET', '/api/user', [], [
            'Authorization' => "Bearer $token"
        ]);
        $response
            ->assertStatus(200);
    }
}
