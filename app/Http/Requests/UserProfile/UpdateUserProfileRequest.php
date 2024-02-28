<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();

        // if (Auth::check()) {
        //     return Auth::user()->hasAccess("userprofile.update") || $this->isUpdatingSelf();
        // }
    }
     /**
     * Returns true if the current user session is equal to the user we're updating, else false.
     *
     * @return boolean
     */

    //commented for now since HR staff must be allowed to edit other Users Profiles
    // private function isUpdatingSelf()
    // {
    //     $user = Auth::user();
    //     return $user->id === $this->user->id;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {     
            return [
                "firstname"     => ["required", "string"],
                "lastname"      => ["required", "string"],
                "middlename"    => ["required", "string"],
                "address"       => ["required", "string"],
                "birthday"      => ["required", "date"],
                "gender"        => ["required", "string"],
                "pay"           => ["required", "numeric"],
                "phone"         => ["required", "string", "unique:user_profiles,phone"],
    
            ];  
    }
}
