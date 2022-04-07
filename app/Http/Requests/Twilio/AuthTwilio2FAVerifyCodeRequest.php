<?php

namespace App\Http\Requests\Twilio;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthTwilio2FAVerifyCodeRequest extends FormRequest
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
            'code' => ['string', 'required']
        ];
    }
}
