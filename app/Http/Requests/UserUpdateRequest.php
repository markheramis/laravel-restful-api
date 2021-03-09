<?php

namespace App\Http\Requests;

use Auth;
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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['string', 'max:255', 'unique:users', 'alpha_dash'],
            'email' => ['string', 'max:255', 'unique:users', 'email'],
        ];
    }
}
