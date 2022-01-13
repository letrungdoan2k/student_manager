<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $requestRule = [
            'name' => 'required|max:50',
            'birthday' => 'required|date',
            'phone' => 'required|min:9|max:11|numeric',
            'email' => 'required|email|unique:students',
            'address' => 'required',
            'gender' => 'required',
            'faculty_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:100|unique:students|'
        ];
        if($this->id == null){
            $requestRule['image'] = "required|" . $requestRule['image'];
        }

        return $requestRule;
    }
}
