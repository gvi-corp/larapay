<div class="card">
    <div class="card-header @if(isset($loop_iter) &&  $loop_iter% 2 == 0)bg-secondary @else bg-primary @endif text-white">
        <span>{{$device->name}}</span>
        <a class="float-md-right text-white"
           href="{{route('device.destroy',['device' => $device])}}"
           onclick="event.preventDefault();
               document.getElementById('delete-form-{{ $device->id }}').submit();">
            X
        </a>

        <form id="delete-form-{{ $device->id }}" action="{{ route('device.destroy', ['device' => $device]) }}"
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a class="float-md-right "
               href="{{route('device.edit',['device' => $device])}}"
               >
                Modifier
            </a>
            <dl>
                <dt>
                    Type
                </dt>
                <dd>{{$device->type}}</dd>
            </dl>
            <dl>
                <dt>
                    Os
                </dt>
                <dd>{{$device->os}}</dd>
            </dl>
            <dl>
                <dt>
                    Description
                </dt>
                <dd>
                    {{$device->description}}
                </dd>
            </dl>
        </div>
    </div>
</div>
