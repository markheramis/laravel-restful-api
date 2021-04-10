<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\FormRequest;

class RoleStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->hasAccess("role.store");
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            #"name" => "required",
            #"slug" => "required",
            #"permissions" => "array|required"
        ];
    }

    public function bodyParameters()
    {
        return [
            /*
            "name" => [
                "description" => "The name of the new Role",
                "example" => "Admin",
            ],
            "slug" => [
                "description" => "The slug of the new Role",
                "example" => "admin",
            ],
            "permissions" => [
                "description" => "The permission for this Role",
                "example" =>  [
                    "test.all" => true,
                    "test.get" => true,
                    "test.add" => false,
                    "test.update" => false,
                    "test.delete" => false,
                ]
            ]
            */];
    }
}
