<?php

namespace App\Http\Requests\UserMeta;

use Auth;
use App\Http\Requests\FormRequest;

class UserMetaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return Auth::user()->hasAccess("user.meta.store");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_id" => ["number", "required"],
            "meta_value" => ["nullable", "array", "min:1", "max:10"],
            "autoload" => ["boolean", "nullable"],
        ];
    }
}
