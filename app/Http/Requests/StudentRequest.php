<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
        $max_age = Carbon::now()->subYears(100);
        $requestRule = [
            'name' => 'required|max:50',
            'birthday' => 'required|date|before:now|after:' . $max_age,
            'phone' => 'required|numeric|digits_between:9,10',
            'email' => [
                'required',
                'email',
                Rule::unique('students')->ignore($this->id)
            ],
            'address' => 'required|max:255',
            'gender' => 'required|between:1,2',
            'faculty_id' => 'required|exists:faculties,id',
            'image' => 'image',
            'subject_id. *' => 'required|exists:subjects,id',
            'point. *' => 'required|min:0|max:10'
        ];

        if ($this->id == null) {
            $requestRule['image'] = "required|" . $requestRule['image'];
        }


        return $requestRule;
    }
}
