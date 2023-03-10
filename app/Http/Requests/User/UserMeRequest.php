<?php

namespace App\Http\Requests\User;

use Auth;
use App\Http\Requests\FormRequest;

class UserMeRequest extends FormRequest {

    public function authorize(): bool {
        return Auth::check();
    }

    public function rules(): array {
        return [];
    }

}
