<?php

namespace App\Http\Requests\Media;

use Auth;
use App\Http\Requests\FormRequest;

class MediaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!Auth::check()) return;
        return Auth::user()->hasAccess("media.store");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "file" => ["file", "required"],
            "status" => ["string", "nullable"],
            "description" => ["string", "nullable"],
            "meta" => ["nullable", "array", "min:0", "max:10"],
            // exclusive to dentalray
            "meta.is_dicom" => ["nullable", "boolean"],
        ];
    }


    protected function prepareForValidation()
    {
        if (isJson($this->meta))
            $this->merge([
                'meta' => json_decode($this->meta, true) ?? [],
            ]);
    }
}
