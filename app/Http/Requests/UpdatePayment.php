<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePayment extends FormRequest
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
                 'title.string' => 'string',
            ],
            'amount' => [
                'amount.numeric' => 'numeric',
            ],
            'currency' => [
                'currency.in' => Rule::in(['Euros', 'USD', 'GBP']),
            ],
            'seller' => [
                'seller.string' => 'string',
            ],
            'digitized_card_id' => [
                'digitized_card_id.integer' => 'integer',
                'digitized_card_id.exists' => Rule::exists('digitized_cards', 'id')->where('user_id', auth()->user()->id),
            ],
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'Please enter a valid string !',

            'amount.numeric' => 'Please enter a valid amount for your payment !',

            'currency.in' => 'Please enter a valid currency for your payment !',

            'seller.string' => 'Please enter a valid seller for your payment !',

            'digitized_card_id.integer' => 'Please choose a valid digitized card for your payment !',
            'digitized_card_id.exists' => 'Please choose a valid digitized card for your payment !',
        ];
    }
}
