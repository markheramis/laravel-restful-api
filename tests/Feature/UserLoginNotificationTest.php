<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Tests\Traits\userTraits;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Notifications\User\UserLoggedInNotification;

class UserLoginNotificationTest extends TestCase
{
    use WithFaker, userTraits;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotificationSentToAdminsWhenUserLogInListenerTriggered()
    {
        Notification::fake();
        $user = $this->createUser();
        $response = $this->json("POST", route("api.login"), [
            "username" => $user->username,
            "password" => "password12345"
        ]);
        $response->assertStatus(200);

        $admins = User::whereHas('roles', function ($query) {
            $query->where('roles.id', Role::ROLE_ADMIN);
        })->get();
        Notification::assertSentTo(
            $admins,
            UserLoggedInNotification::class
        );
    }
}
