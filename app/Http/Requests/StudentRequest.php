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
        $rules = [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->user->id
            ],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => __(':attribute is required.'),
            'email.required' => __(':attribute is required.'),
            'email.email' => __(':attribute must be correct email'),
            'email.unique' => __('The :attribute has been taken'),
            'phone.regex' => __(''),
            'phone.required' => __(':attribute is required.'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Student Name'),
            'email' => __('Student E-Mail'),
            'phone' => __('Student Phone')
        ];
    }
}
