<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\FormRequest;

class UserPermissionDestroyRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    if (Auth::check()) {
      $user = Auth::user();
      return $user->hasAccess("user.permission.delete");
    } else {
      return false;
    }
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
