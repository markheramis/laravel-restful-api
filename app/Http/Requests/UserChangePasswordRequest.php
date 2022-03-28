<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password_current" => "string|required|current_password:api",
            "password" => "string|required",
            "password_confirmation" => "string|required|min:6|max:15",
        ];
    }
}
