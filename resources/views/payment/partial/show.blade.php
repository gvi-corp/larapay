<div class="card">
    <div
        class="card-header @if(isset($loop_iter) &&  $loop_iter% 2 == 0)bg-secondary @else bg-primary @endif text-white">
        <span>{{$payment->title}}</span>
        <a class="float-md-right text-white"
           href="{{route('payment.destroy',['payment' => $payment])}}"
           onclick="event.preventDefault();
               document.getElementById('delete-form-{{ $payment->id }}').submit();">
            X
        </a>

        <form id="delete-form-{{ $payment->id }}" action="{{ route('payment.destroy', ['payment' => $payment]) }}"
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a class="float-md-right "
               href="{{route('payment.edit',['payment' => $payment])}}"
            >
                Modifier
            </a>
            <i>Booked date : {{$payment->created_at}}</i>
            <dl>
                <dt>
                    Amount
                </dt>
                <dd>{{$payment->amount}} {{$payment->currency}}</dd>
            </dl>
            <dl>
                <dt>
                    Payment to :
                </dt>
                <dd>{{$payment->seller}}</dd>
            </dl>
            <dl>
                <dt>
                    Digitized Card
                </dt>
                <dd>{{$payment->digitized_card->name}}</dd>
            </dl>
            <dl>
                <dt>
                    Description
                </dt>
                <dd>
                    {{$payment->description}}
                </dd>
            </dl>

        </div>
    </div>
</div>
