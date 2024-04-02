<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check() && Auth::user()->hasAccess("user.store"));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username"                  => ["required", "min:2", "max:255"],
            "email"                     => ["required", "email", "unique:users,email"],
            "password"                  => ["required",  "min:8", "string"],
            "v_password"                => ["required_with:password", "same:password", "min:8", "max:255"],
            "role"                      => ["nullable", "string"],
            "permissions"               => ["nullable", "array"],
            "activate"                  => ["nullable", "boolean"],
        ];
    }
}
