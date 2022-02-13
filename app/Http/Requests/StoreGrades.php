<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
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
            'grade_name_en' =>'required',
            'grade_name_ar'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'grade_name_en.required' => trans('validation.required'),
            'grade_name_ar.required' => trans('validation.required'),

        ];
    }
}
