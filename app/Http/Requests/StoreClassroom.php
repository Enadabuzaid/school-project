<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
            'list' => 'required',
            'name_ar' => 'required',
            'grade' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'list.required' => trans('validation.required'),
            'name_ar.required' => trans('validation.required'),
            'grade.required' => trans('validation.required'),

        ];
    }
}
