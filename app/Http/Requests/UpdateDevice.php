<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDevice extends FormRequest
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
                'name.string' => 'string',
                'name.unique' => Rule::unique('devices')->where('user_id', auth()->user()->id)->ignore($this->route('device'))
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
            'name.string' => 'Please enter a valid string !',
            'type.enum' => 'Choose a valid type of device !',
            'os.enum' => 'Choose a valid OS for the device !'
        ];
    }
}
