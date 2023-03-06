<?php

namespace App\Http\Requests\UserPermission;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserPermissionUpdateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return (Auth::check() && Auth::user()->hasAccess("user.permission.update"));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
                //
        ];
    }

}
