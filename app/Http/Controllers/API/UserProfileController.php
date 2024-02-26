<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function index(Request $request) {
        $profiles = UserProfile::all();
        return response()->success($profiles);
    }
    
      /**
     * Show User Profile
     * 
     * This endpoint allows you to show a user profile that matches the ID
     *
     * @authenticated
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function show(Request $request, int $id) {
        $profile = UserProfile::find($id);
        return response()->success($profile);
    }

     /**
     * Store User Profile
     * 
     * This endpoint allows you to store a new user profile
     *
     * @authenticated
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function store(Request $request, int $id) {
        $profile = new UserProfile;
        $profile->user_id = $id;
        $profile->address = $request->address;
        $profile->contact = $request->contact;
        // ... etc ...
        $profile->save();
        return response()->success($profile);
    }

}
