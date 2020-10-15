<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePAN extends FormRequest
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
                //requiring Mastercard PAN pattern
                'pan.regex' => 'regex:/^5[1-5]\d{14}$/',
                //requiring Visa PAN pattern
                //'regex:^4\d{15}$'
                'pan.unique' => Rule::unique('pans','pan')->ignore($this->route('pan'))
            ],
            'name' => [
                'name.unique' => Rule::unique('pans','name')->ignore($this->route('pan'))
            ],
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'pan.regex' => 'Wrong PAN Pattern !',
            'pan.unique' => 'Already in use !',
            'name.unique' => 'Already in use !',
        ];
    }


}
