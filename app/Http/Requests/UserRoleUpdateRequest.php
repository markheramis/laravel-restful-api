<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserRoleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $can_update_role = Sentinel::findById($user->id)->hasAccess("user.role.update");
        return $can_update_role;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'slug' => ['required', 'min:2', 'max:20'],
        ];
    }
}
