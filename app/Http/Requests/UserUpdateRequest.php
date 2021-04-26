<?php

namespace App\Http\Requests;

use Log;
use Auth;
use App\Models\User;
use App\Http\Requests\FormRequest;


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
        $can_update = $user->hasAccess("user.update");
        return (bool) $can_update || $this->isUpdatingSelf();
    }

    private function isUpdatingSelf()
    {
        $user = Auth::user();
        $request_slug = request()->slug;
        return $user->slug == $request_slug;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => ["min:8", "max:255", "unique:users"],
            "email" => ["min:8", "max:255", "unique:users", "email"],
        ];
    }
}
