<?php

namespace Tests\Feature\User\Index;

use Tests\TestCase;
use App\Models\User;
use App\Transformers\UserTransformer;
use Tests\Traits\userTraits;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\JsonApiSerializer;

class UserIndexAsAdministratorResponseCodeTest extends TestCase
{
    use userTraits;

    public function testIndexAllUserAsAdminsShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $token = $this->getTokenByRole("administrator", $user->id);
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

    public function testIndexAllUserAsAdminsShouldBeAllowedWhenMfaEnabled()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
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

    public function testIndexAllUserAsAdminsShouldNotBeAllowedWhenMfaEnabledButNotMfaVerified()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, false);
        $response = $this->json("GET", route("user.index"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(403);
        $user->delete();
    }

    public function testIndexAllUsersAsAdministratorByRoleAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $userPaginator = User::whereHas("roles", function ($query) {
            $query->where("slug", "administrator");
        })->paginate();
        $userCollection = $userPaginator->getCollection();
        $expected_response = fractal()
            ->collection($userCollection)
            ->transformWith(new UserTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($userPaginator))
            ->toArray();
        $response = $this->json("GET", route("user.index"), [
            "role" => "administrator"
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath("data", $expected_response["data"]);
        $response->assertJsonPath("meta", $expected_response["meta"]);
        $user->delete();
    }

    public function testIndexAllUsersAsAdministratorByRoleModeratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator", true, true);
        $token = $this->getTokenByRole("administrator", $user->id, true);
        $userPaginator = User::whereHas("roles", function ($query) {
            $query->where("slug", "moderator");
        })->paginate();
        $userCollection = $userPaginator->getCollection();
        $expected_response = fractal()
            ->collection($userCollection)
            ->transformWith(new UserTransformer)
            ->serializeWith(new JsonApiSerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($userPaginator))
            ->toArray();
        $response = $this->json("GET", route("user.index"), [
            "role" => "moderator"
        ], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJsonPath("data", $expected_response["data"]);
        $response->assertJsonPath("meta", $expected_response["meta"]);
        $user->delete();
    }
}
