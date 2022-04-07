<?php

namespace App\Http\Requests\OAuth;

use Auth;
use Laravel\Passport\Passport;
use App\Http\Requests\FormRequest;

class PersonalAccessTokenStoreRequest extends FormRequest
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
            "name" => "required|max:191",
            "scopes" => "array|in:" . implode(',', Passport::scopeIds()),
        ];
    }
}
