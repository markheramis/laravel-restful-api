<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

abstract class FormRequest extends LaravelFormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  abstract public function rules();

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  abstract public function authorize();

  /**
   * Handle a failed validation attempt.
   *
   * @param  \Illuminate\Contracts\Validation\Validator $validator
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    $errors = (new ValidationException($validator))->errors();
    throw new HttpResponseException(
      response()->error($errors, 'Data validation failed', JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
    );
  }

  /**
   * Handle a failed authorization attempt
   *
   * @return void
   *
   * @throws \Illuminate\Auth\Access\AuthorizationException
   */
  protected function failedAuthorization()
  {
    throw new HttpResponseException(response()->json([
      'status' => 'error',
      'message' => 'Access Forbidden'
    ], JsonResponse::HTTP_FORBIDDEN));
  }
}
