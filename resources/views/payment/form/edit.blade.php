@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('payment.update',['payment' => $payment])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="payment-title">Payment Title</label>
                        <input type="text" class="form-control" id="payment-title" aria-describedby="payment-tile"
                               name="title"
                               value="{{$payment->title}}"
                               placeholder="Enter title for payment"
                        >
                        @error('title')
                        <small id="payment-name-error"
                               class="form-text text-muted alert-danger">{{$errors->first('title')}}</small>
                        @enderror

                        <label for="payment-amount">Amount</label>
                        <input type="text" class="form-control" id="payment-amount" aria-describedby="payment-amount"
                               name="amount"
                               value="{{$payment->amount}}"
                               placeholder="Enter payment amount"
                        >
                        @error('amount')
                        <small id="payment-amount-error"
                               class="form-text text-muted alert-danger">{{$errors->first('amount')}}</small>
                        @enderror


                        <label for="payment-currency">Choose currency : </label>
                        <select type="text" class="form-control" id="payment-currency"
                                aria-describedby="payment-currency"
                                name="currency">
                            @foreach(['Euros','USD','GBP'] as $currency)
                                <option value="{{$currency}}"
                                        @if($currency == $payment->currency) selected="selected" @endif>
                                    {{$currency}}
                                </option>>
                            @endforeach
                        </select>
                        @error('currency')
                        <small id="payment-currency-error"
                               class="form-text text-muted alert-danger">{{$errors->first('currency')}}</small>
                        @enderror

                        <label for="payment-seller">Seller to pay</label>
                        <input type="text" class="form-control" id="payment-seller" aria-describedby="payment-seller"
                               name="seller"
                               value="{{$payment->seller}}"
                               placeholder="Enter whom to pay"
                        >
                        @error('seller')
                        <small id="payment-seller-error"
                               class="form-text text-muted alert-danger">{{$errors->first('seller')}}</small>
                        @enderror


                        <label for="payment-dc">Digitized Card</label>
                        <select type="text" class="form-control" id="payment-dc" aria-describedby="payment-dc"
                                name="digitized_card_id">
                            @foreach(@auth()->user()->digitized_cards as $dc)
                                <option value="{{$dc->id}}"
                                        @if($dc == $payment->digitized_card) selected="selected" @endif
                                >
                                    {{$dc->name}}
                                </option>>
                            @endforeach
                        </select>
                        @error('digitized_card_id')
                        <small id="payment-dc-error"
                               class="form-text text-muted alert-danger">{{$errors->first('digitized_card_id')}}</small>
                        @enderror

                        <label for="payment-desc">Description</label>
                        <textarea class="form-control" id="payment-desc" aria-describedby="payment-desc"
                                  name="description"
                                  placeholder="Enter your Digitized Card Description"
                        >{{
                        $payment->description
                        }}</textarea>
                        @error('description')
                        <small id="payment-desc-error"
                               class="form-text text-muted alert-danger">{{$errors->first('payment_desc')}}</small>
                        @enderror


                        <input type="submit" value="Update">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
