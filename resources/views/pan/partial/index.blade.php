@foreach(auth()->user()->pans as $pan)
    <p>
        @include('pan.partial.show',['pan' => $pan,'loop_iter' => $loop->iteration])
    </p>
@endforeach
