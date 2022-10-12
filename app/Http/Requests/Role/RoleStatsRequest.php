<?php

namespace App\Http\Requests\Role;

use App\Models\Role;
use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleStatsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        $user = Auth::user();
        $role = Role::where('name', 'administrator')->first();
        return $user->inRole($role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
