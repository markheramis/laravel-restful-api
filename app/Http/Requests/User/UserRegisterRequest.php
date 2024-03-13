<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => ["required", "min:5", "max:255"],
            "email"     => ["required", "email", "unique:users,email", "min:10", "max:255"],
            "password"  => ["required", "string", "min:8", "max:255"],
            "v_password" => ["required_with:password", "same:password", "min:8", "max:255"],
            "role" => ["nullable", "string"],
            "permissions" => ["nullable", "array"],
            "activate" => ["nullable", "boolean"],
        ];
    }
}
