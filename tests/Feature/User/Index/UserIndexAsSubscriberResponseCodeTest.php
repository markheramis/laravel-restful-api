<?php

namespace Tests\Feature\User\Index;

use Tests\TestCase;
use App\Models\User;
use App\Transformers\UserTransformer;
use Tests\Traits\userTraits;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class UserIndexAsSubscriberResponseCodeTest extends TestCase
{
    use userTraits;

    public function testIndexAllUserAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser("subscriber");
        $token = $this->getTokenByRole("subscriber", $user->id);
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

    public function testIndexAllUserAsSubscriberShouldBeAllowedWhenMfaEnabled()
    {
        $user = $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, true);
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

    public function testIndexAllUserAsSubscriberShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("subscriber", true, true);
        $token = $this->getTokenByRole("subscriber", $user->id, false);
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user->delete();
    }
}
