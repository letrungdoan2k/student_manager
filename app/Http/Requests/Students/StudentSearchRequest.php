<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class StudentSearchRequest extends FormRequest
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
            'from-point' => 'nullable|numeric|min:0|max:10',
            'to-point' => 'nullable|numeric|min:0|max:10',
            'from-age' => 'nullable|numeric|min:0|max:100',
            'to-age' => 'nullable|numeric|min:0|max:100',
        ];
    }
}
