<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerNumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "value" => "between:-2147483648.0,2147483647.0|required",
            "error" => "between:-2147483648.0,2147483647.0",
            "step_id" => "integer",
        ];
    }
}
