<?php

namespace App\Http\Requests;

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
            "username" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "role" => "required",
            "activate" => "required"
        ];
    }
}
