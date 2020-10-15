<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePAN extends FormRequest
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
            'pan' => [
                'pan.required' => 'required',
                'pan.filled' => 'filled',
                'pan.integer' => 'integer',
                //requiring Mastercard PAN pattern
                'pan.regex' => 'regex:/^5[1-5]\d{14}$/',
                //requiring Visa PAN pattern
                //'regex:^4\d{15}$'
                'pan.unique' => 'unique:pans,pan'
            ],
            'name' => [
                'name.required' => 'required',
                'name.filled' => 'filled',
                'name.unique' => 'unique:pans,name,user_id'
            ],
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'pan.required' => 'Required !',
            'pan.filled' => 'Must not be empty !',
            'pan.integer' => 'Please Enter a Number !',
            'pan.regex' => 'Wrong PAN Pattern !',
            'pan.unique' => 'Already in use !',
            'name.required' => 'Required !',
            'name.filled' => 'Must not be empty !',
            'name.unique' => 'Already in use !'
        ];
    }


}
