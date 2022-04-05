<?php

namespace App\Http\Requests\UserRole;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRoleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return Auth::user()->hasAccess("user.role.store");
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
