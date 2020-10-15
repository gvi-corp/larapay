<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePayment extends FormRequest
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
            'title' => [
                'title.required' => 'required',
                'title.filled' => 'filled',
                'title.string' => 'string',
            ],
            'amount' => [
                'amount.required' => 'required',
                'amount.filled' => 'filled',
                'amount.numeric' => 'numeric',
            ],
            'currency' => [
                'currency.required' => 'required',
                'currency.filled' => 'filled',
                'currency.in' => Rule::in(['Euros', 'USD', 'GBP']),
            ],
            'seller' => [
                'seller.required' => 'required',
                'seller.filled' => 'filled',
                'seller.string' => 'string',
            ],
            'digitized_card_id' => [
                'digitized_card_id.required' => 'required',
                'digitized_card_id.filled' => 'filled',
                'digitized_card_id.integer' => 'integer',
                'digitized_card_id.exists' => Rule::exists('digitized_cards', 'id')->where('user_id', auth()->user()->id),
            ],
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Please enter a title for the new device !',
            'title.filled' => 'Please enter a string !',
            'title.string' => 'Please enter a valid string !',

            'amount.required' => 'Please enter an amount for your payment !',
            'amount.filled' => 'Please enter a valid amount for your payment !',
            'amount.numeric' => 'Please enter a valid amount for your payment !',

            'currency.required' => 'Please enter a currency for your payment !',
            'currency.filled' => 'Please enter a valid currency for your payment !',
            'currency.in' => 'Please enter a valid currency for your payment !',

            'seller.required' => 'Please enter a seller for your payment !',
            'seller.filled' => 'Please enter a valid seller for your payment !',
            'seller.string' => 'Please enter a valid seller for your payment !',

            'digitized_card_id.required' => 'Please choose one of your digitized card for your payment !',
            'digitized_card_id.filled' => 'Please choose a valid digitized card for your payment !',
            'digitized_card_id.integer' => 'Please choose a valid digitized card for your payment !',
            'digitized_card_id.exists' => 'Please choose a valid digitized card for your payment !',
        ];
    }
}
