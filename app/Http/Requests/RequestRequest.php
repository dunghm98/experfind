<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRequest extends FormRequest
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
        $rules = [
//            'short_description' => 'required',
//            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
//            'description' => 'required',
//            'subject' => 'required',
//            'expect_fee' => 'required',
//            'number_of_hour' => 'required',
//            'learning_method' => 'required',
//            'tutor_gender' => 'required',
//            'type_of_tutor' => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'short_description.required' => __(':attribute is required.'),
            'phone.regex' => __(''),
            'phone.required' => __(':attribute is required.'),
        ];
    }

    public function attributes()
    {
        return [
            'short_description' => __('Short description'),
            'phone' => __('Student Phone')
        ];
    }
}
