<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;

class UserActivateRequest extends FormRequest
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
            "code" => "required|string",
        ];
    }

    public function bodyParameters()
    {
        return [
            "code" => [
                "description" => "The activation code",
                "example" => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
            ]
        ];
    }
}
