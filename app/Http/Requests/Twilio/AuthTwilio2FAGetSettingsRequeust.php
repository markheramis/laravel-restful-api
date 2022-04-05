<?php

namespace App\Http\Requests\Twilio;

use Auth;
use App\Http\Requests\FormRequest;

class AuthTwilio2FAGetSettingsRequeust extends FormRequest
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
            //
        ];
    }
}
