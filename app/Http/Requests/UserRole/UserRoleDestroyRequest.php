<?php

namespace App\Http\Requests\UserRole;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRoleDestroyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check() && Auth::user()->hasAccess("user.role.destroy"));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "slug" => ["min:2", "max:100"],
        ];
    }
}
