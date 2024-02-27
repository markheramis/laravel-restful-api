<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ShowUserProfileRequest;
use App\Http\Requests\User\DeleteUserProfileRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Http\Requests\User\StoreUserProfileRequest;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function index($request) {
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

     public function show(ShowUserProfileRequest $request, int $id) {
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
    public function store(StoreUserProfileRequest $request, int $id) {
        $profile = new UserProfile;
        $profile->user_id = $id;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->middlename = $request->middlename;
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
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(UpdateUserProfileRequest $request, UserProfile $profile, int $id){
        $profile = UserProfile::find($id);
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->middlename = $request->middlename;
        $profile->address = $request->address;
        $profile->birthday = $request->birthday;
        $profile->gender = $request->gender;
        $profile->pay = $request->pay;
        $profile->phone = $request->phone;
        $profile->save();
        return responce()->success($profile);
    }
     /**
     * Delete User Profile
     * 
     * This endpoint allows you to delete a new user profile
     *
     * @authenticated
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy(DestroyUserProfileRequest $request, UserProfile $profile, int $id){
        $profile->delete();
        return response()->success('User Deleted');
    }

}
