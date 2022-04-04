<?php

namespace App\Http\Requests\Option;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class OptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return Auth::user()->hasAccess("option.store");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|required',
            'value' => 'required',
        ];
    }
}
