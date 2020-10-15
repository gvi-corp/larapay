@foreach(auth()->user()->devices as $device)
    <p>
        @include('device.partial.show',['device' => $device,'loop_iter' => $loop->iteration])
    </p>
@endforeach
