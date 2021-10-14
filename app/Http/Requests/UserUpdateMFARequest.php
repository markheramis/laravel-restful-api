<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateMFARequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return $this->isUpdatingSelf();
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
            'default_factor' => 'required',
        ];
    }
}
