<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserRoleDestroyRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    $user = Auth::user();
    $can_delete_role = Sentinel::findById($user->id)->hasAccess("user.role.delete");
    return $can_delete_role;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      "slug" => ["min:2", "max:100"],
    ];
  }
}
