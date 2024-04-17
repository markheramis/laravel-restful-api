<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;

use App\Http\Requests\UserProfile\ShowUserProfileRequest;
use App\Http\Requests\UserProfile\ShowAllUserProfileRequest;
use App\Http\Requests\UserProfile\DeleteUserProfileRequest;
use App\Http\Requests\UserProfile\UpdateUserProfileRequest;
use App\Http\Requests\UserProfile\StoreUserProfileRequest;


/**
 * @group  User Profile Management
 *
 * APIs for managing Users Meta Data
 */
class UserProfileController extends Controller
{

     /**
     * Show All User Profile
     * 
     * This endpoint allows you to show all user profiles
     *
     * @authenticated
     * @param ShowAllUserProfileRequest $request
     * @return void
     */
    public function index(ShowAllUserProfileRequest $request) {
        $profiles = UserProfile::all();
        return response()->success($profiles);
    }
    
      /**
     * Show User Profile
     * 
     * This endpoint allows you to show a user profile that matches the user ID
     *
     * @authenticated
     * @param ShowUserProfileRequest $request
     * @param integer $userid
     * @return void
     */

     public function show(ShowUserProfileRequest $request, int $userid) {
        $profile = new UserProfile;
        $profile = UserProfile::where('user_id', $userid)->first();
        return response()->success($profile);
    }


     /**
     * Store User Profile
     * 
     * This endpoint allows you to store a new user profile
     *
     * @authenticated
     * @param StoreUserProfileRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function store(StoreUserProfileRequest $request) {
        $profile = new UserProfile;
        $profile->user_id = $request->userid;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->middlename = $request->middlename;
        $profile->position = $request->position;
        $profile->address = $request->address;
        $profile->birthday = $request->birthday;
        $profile->gender = $request->gender;
        $profile->pay = $request->pay;
        $profile->phone = $request->phone;
        $profile->save();
        return response()->success($profile);
    }

     /**
     * Update User Profile
     * 
     * This endpoint allows you to update a new user profile
     *
     * @authenticated
     * @param UpdateUserProfileRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(UpdateUserProfileRequest $request, int $userid){
        $profile = new UserProfile;
        $profile = UserProfile::where('user_id', $userid)->first();
        
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->middlename = $request->middlename;
        $profile->position = $request->position;
        $profile->address = $request->address;
        $profile->birthday = $request->birthday;
        $profile->gender = $request->gender;
        $profile->pay = $request->pay;
        $profile->phone = $request->phone;
        $profile->save();
        return response()->success($profile);
    }
     /**
     * Delete User Profile
     * 
     * This endpoint allows you to delete a new user profile
     *
     * @authenticated
     * @param DeleteUserProfileRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy(DeleteUserProfileRequest $request, int $id){
        $profile = UserProfile::find($id);
        $profile->delete();
        return response()->success('User Profile Deleted');
    }

}
