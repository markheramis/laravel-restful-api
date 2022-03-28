<?php

namespace Tests\Feature;

use Log;
use Tests\TestCase;
use Tests\Traits\userTraits;
use App\Events\User\UserLoggedIn;
use Illuminate\Support\Facades\Event;
use App\Listeners\User\UserLoggedInListener;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserLoggedInNotification;

class UserSessionTest extends TestCase
{
    use WithFaker, userTraits;


    public function testGetCurrentUserWithoutSessionShouldBeUnauthorized()
    {
        $response = $this->json("GET", route("api.me"));
        $response->assertStatus(401);
    }

    public function testGetCurrentUserAsSubscriberShouldBeAllowed()
    {
        $user = $this->createUser('subscriber');
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole('subscriber', $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }

    public function testGetCurrentUserAsModeratorShouldBeAllowed()
    {
        $user = $this->createUser("moderator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("moderator", $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token",
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }

    public function testGetCurrentUserAsAdministratorShouldBeAllowed()
    {
        $user = $this->createUser("administrator");
        $user->roles = $user->roles()->select('slug', 'name', 'permissions')->get();
        $token = $this->getTokenByRole("administrator", $user->id);
        $response = $this->json("GET", route("api.me"), [], [
            "Authorization" => "Bearer $token"
        ]);
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                "id" => $user->id,
                "username" => $user->username,
                "email" => $user->email,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "roles" => $user->roles->toArray(),
            ]
        ]);
        $user->delete();
    }

    public function testUserLoginMustHaveSessionData()
    {
        Event::fake([UserLoggedIn::class]);
        
        $user = $this->createUser();
        $response = $this->actingAs($user)->withSession(["user" => $user])->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);

        $response->assertStatus(200);
        $response->assertSessionHas('user.id', $user->id);

        $user->delete();
        Event::assertDispatched(UserLoggedIn::class);
        Event::assertListening(
            UserLoggedIn::class,
            UserLoggedInListener::class,
        );
    }

    public function testUserLogoutMustDestroySession()
    {
        $user = $this->createUser();
        $response = $this->actingAs($user)->withSession(["user" => $user])->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $token = $response->json()['data']['token'];
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->actingAs($user)->json("POST", route("api.logout"), []);

        $response->assertStatus(200);
        $response->assertJsonStructure(['success']);

        $this->assertTrue(auth('api')->user()->token()->revoked);
        session()->forget('user');
        
        $response->assertSessionMissing('user.id', $user->id);
        $user->delete();
    }
}
