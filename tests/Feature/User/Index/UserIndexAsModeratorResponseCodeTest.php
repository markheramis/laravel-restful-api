<?php

namespace Tests\Feature\User\Index;

use Tests\TestCase;
use App\Models\User;
use App\Transformers\UserTransformer;
use Tests\Traits\userTraits;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class UserIndexAsModeratorResponseCodeTest extends TestCase
{
    use userTraits;

    public function testIndexAllUserAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $token = $this->getTokenByRole("moderator", $user->id);
        $userPaginator = User::paginate();
        $userCollection = $userPaginator->getCollection();
        $expected_response = fractal()
            ->collection($userCollection)
            ->transformWith(new UserTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($userPaginator))
            ->toArray();
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath("data", $expected_response["data"]);
        $response->assertJsonPath("meta", $expected_response["meta"]);
        $user->delete();
    }

    public function testIndexAllUserAsModeratorShouldBeAllowedWhenMfaEnabled()
    {
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, true);
        $userPaginator = User::paginate();
        $userCollection = $userPaginator->getCollection();
        $expected_response = fractal()
            ->collection($userCollection)
            ->transformWith(new UserTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($userPaginator))
            ->toArray();
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath("data", $expected_response["data"]);
        $response->assertJsonPath("meta", $expected_response["meta"]);
        $user->delete();
    }

    public function testIndexAllUserAsModeratorShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("moderator", true, true);
        $token = $this->getTokenByRole("moderator", $user->id, false);
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user->delete();
    }
}
