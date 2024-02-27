<?php

namespace App\Http\Requests\UserProfile;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

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
            "pay"           => ["required", "numberic"],
            "phone"         => ["required", "string", "unique:user_profiles,phone"],

        ];
    }
}
