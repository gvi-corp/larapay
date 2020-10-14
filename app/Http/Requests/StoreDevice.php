<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDevice extends FormRequest
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
            'name' => [
                'name.required' => 'required',
                'name.filled' => 'filled',
                'name.string' => 'string',
                'name.unique' => Rule::unique('devices')->where('user_id', auth()->user()->id)
            ],
            'type' => [
                'nullable',
                'type.enum' => Rule::in(['Smartphone', 'Tablet', 'Watch', 'Other'])
            ],
            'os' => [
                'nullable',
                'os.enum' => Rule::in(['Android', 'iOS', 'Other'])
            ],
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter a name for the new device !',
            'name.filled' => 'Please enter a string !',
            'name.string' => 'Please enter a valid string !',
            'type.enum' => 'Choose a valid type of device !',
            'os.enum' => 'Choose a valid OS for the device !'
        ];
    }
}
