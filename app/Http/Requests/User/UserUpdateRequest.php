<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return Auth::user()->hasAccess("user.update") || $this->isUpdatingSelf();
    }

    /**
     * Returns true if the current user session is equal to the user we're updating, else false.
     *
     * @return boolean
     */
    private function isUpdatingSelf()
    {
        $user = Auth::user();
        return $user->id === $this->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => ["required", "min:5", "max:255"],
            "email" => ["required", "email", "max:255"],
            "first_name" => ["min:2", "max:100"],
            "last_name" => ["min:2", "max:100"],
            "role" => ['nullable'],
        ];
    }
}
