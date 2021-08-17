<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        $can_update = Sentinel::findById($user->id)->hasAccess("user.update");
        return $can_update || $this->isUpdatingSelf();
    }

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
        $handle_unique = Rule::unique('users')->ignore($this->user);
        return [
            "username" => ["required", "min:8", "max:255", $handle_unique],
            "email" => ["required", "email", "max:255", $handle_unique],
            "first_name" => ["min:2", "max:100"],
            "last_name" => ["min:2", "max:100"],
        ];
    }
}
