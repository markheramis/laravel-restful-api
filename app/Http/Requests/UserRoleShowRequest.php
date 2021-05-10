<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;

class UserRoleShowRequest extends FormRequest
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
    return $user->hasAccess("user.role.show");
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
