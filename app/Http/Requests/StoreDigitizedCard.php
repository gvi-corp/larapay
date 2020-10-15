<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDigitizedCard extends FormRequest
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
                'name.unique' => Rule::unique('digitized_cards')->where('user_id', auth()->user()->id)
            ],
            'pan_id' => [
                'pan_id.required' => 'required',
                'pan_id.filled' => 'filled',
                'pan_id.integer' => 'integer',
                'pan_id.exists' => Rule::exists('pans', 'id')->where('user_id', auth()->user()->id),
                'pan_id.unique' => 'unique:digitized_cards,pan_id,NULL,id,device_id,' . request()->device_id
            ],
            'device_id' => [
                'device_id.required' => 'required',
                'device_id.filled' => 'filled',
                'device_id.integer' => 'integer',
                'device_id.exists' => Rule::exists('devices', 'id')->where('user_id', auth()->user()->id),
                'device_id.unique' => 'unique:digitized_cards,device_id,NULL,id,pan_id,' . request()->pan_id
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
            'pan_id.required' => 'Choose a valid PAN (id)',
            'pan_id.filled' => 'Choose a valid PAN (id)',
            'pan_id.integer' => 'Choose a valid PAN (id)',
            'pan_id.exists' => 'Chosen PAN has to be one of yours',
            'device_id.required' => 'Choose a valid device (id)',
            'device_id.filled' => 'Choose a valid device (id)',
            'device_id.integer' => 'Choose a valid device (id)',
            'device_id.exists' => 'Chosen device has to be one of yours',


        ];
    }
}
