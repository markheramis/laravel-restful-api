<?php

namespace Tests\Feature\User\Login;

use Tests\TestCase;
use App\Models\User;
use Tests\Traits\userTraits;
use Lcobucci\JWT\Configuration;
use App\Events\User\UserLoggedIn;
use Illuminate\Support\Facades\Event;
use App\Listeners\User\UserLoggedInListener;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserLoggedInNotification;

class UserLoginTest extends TestCase
{
    use WithFaker, userTraits;

    public function testLoginWithNoParameterShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), []);
        $response->assertStatus(422);
    }

    public function testLoginWithNoPasswordShouldBeUnprocessableEntity()
    {
        $response = $this->json("POST", route("api.login"), [
            "username" => $this->faker->userName(),
        ]);
        $response->assertStatus(422);
    }

    public function testLoginWithWrongPasswordShouldBeUnauthorized()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "p@s5W0rD12347"
        ]);
        $response->assertStatus(401);
        $user->delete();
    }

    public function testLoginWithCorrectCredentialsShouldLoginSuccessfully()
    {
        Event::fake([UserLoggedIn::class]);

        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $user->delete();

        // assert event was dispatched
        Event::assertDispatched(UserLoggedIn::class);
        Event::assertListening(
            UserLoggedIn::class,
            UserLoggedInListener::class,
        );
    }

    public function testLoginWithCorrectCredentialsButWithEmailShouldBeAllowed()
    {
        Event::fake([UserLoggedIn::class]);
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->email,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $user->delete();
        Event::assertDispatched(UserLoggedIn::class);
    }

    public function testLoginWithCorrectCredentialsShouldLoginSuccessfullyWithToken()
    {
        Event::fake([UserLoggedIn::class]);
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertJsonStructure(['data' => ['token', 'mfa_verified']]);
        $response->assertStatus(200);
        $user->delete();

        Event::assertDispatched(UserLoggedIn::class);
    }

    public function testLoginTokenHasMfaVerifiedClaim()
    {
        Event::fake([UserLoggedIn::class]);

        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['token', 'mfa_verified']]);
        $token = $response->json()['data']['token'];

        $jwt = Configuration::forUnsecuredSigner()->parser()->parse($token);
        $mfaVerifiedClaim = $jwt->claims()->get('mfa_verified');

        /* assert our claims were set on the token */
        $this->assertEquals(false, $mfaVerifiedClaim);

        $user->delete();
        Event::assertDispatched(UserLoggedIn::class);
    }

    public function testLoginHasActivityLog()
    {
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('activity_log', [
            'subject_type' => null,
            'event' => 'logged_in',
            'subject_id' => null,
            'causer_id' => $user->id,
            'causer_type' => User::class
        ]);

        $user->delete();
    }
}
