<?php

namespace Tests\Feature\UserMeta\Index;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\userTraits;

class UserMetaIndexResponseCodeTest extends TestCase
{
    use WithFaker, userTraits;

    public function testMetaIndexWithNoSessionShouldBeUnauthorized()
    {
        $user = $this->createUser("administrator", true);
        $response = $this->json("GET", route("user.meta.index", ['user' => $user->id]));
        $response->assertStatus(401);
    }
}
