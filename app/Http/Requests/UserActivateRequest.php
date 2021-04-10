<?php

namespace App\Http\Requests;

use Auth;
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
            "uuid" => "required|string",
            "code" => "required|string",
        ];
    }

    public function bodyParameters()
    {
        return [
            "uuid" => [
                "description" => "The user's UUID",
                "example" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
            ],
            "code" => [
                "description" => "The activation code",
                "example" => "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
            ]
        ];
    }
}
