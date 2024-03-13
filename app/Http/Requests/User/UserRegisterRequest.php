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
            "role" => ["nullable", "string"],
            "permissions" => ["nullable", "array"],
            "activate" => ["nullable", "boolean"],

            //must be removed
            "first_name" => ["nullable", "string", "min:3", "max:255"],
            "last_name" => ["nullable", "string", "min:3", "max:255"],
            "phone_number" => ["nullable", "numeric", "unique:users,phone_number"],
            "country_code" => ["nullable", "numeric"],

        ];
    }
}
