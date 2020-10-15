@foreach(auth()->user()->digitized_cards as $dc)
    <p>
        @include('digitized_card.partial.show',['digitized_card' => $dc,'loop_iter' => $loop->iteration])
    </p>
@endforeach
