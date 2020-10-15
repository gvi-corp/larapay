@foreach($payments as $payment)
    <p>
        @include('payment.partial.show',['payment' => $payment,'loop_iter' => $loop->iteration])
    </p>
@endforeach
