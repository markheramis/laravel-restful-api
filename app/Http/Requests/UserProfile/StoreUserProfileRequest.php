<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "userid"        => ["required", "numeric"],
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
