<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\JsonResponse;
use App\Events\User\UserLoggedOut;
use App\Http\Controllers\Controller;

/**
 * @group User Management
 */
class LogoutController extends Controller
{
    /**
     * Logout API
     * 
     * This endpoint allows you to logout user.
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = auth()->user();
        broadcast(new UserLoggedOut($user->id));
        return response()->json([
            'success' => $user->token()->revoke(),
        ]);
    }
}
