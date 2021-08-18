<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class UserShowRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    $authUser = Auth::user();
    $user = Sentinel::findById($authUser->id);
    return $user->hasAccess("user.show");
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      "username" => "string|regex:/^[A-Za-z]{1}[A-Za-z0-9]{5-31}$/|required|unique:users,username",
      "email" => "email|required|unique:users,email",
      "first_name" => "string|limit:100",
      "last_name" => "string|limit:100"
    ];
  }
}
