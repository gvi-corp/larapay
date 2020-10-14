<div class="card">
    <div class="card-header @if(isset($loop_iter) &&  $loop_iter% 2 == 0)bg-secondary @else bg-primary @endif text-white">
        <span>{{$digitized_card->name}}</span>
        <a class="float-md-right text-white"
           href="{{route('digitized_card.destroy',['digitized_card' => $digitized_card])}}"
           onclick="event.preventDefault();
               document.getElementById('delete-form-{{ $digitized_card->id }}').submit();">
            X
        </a>

        <form id="delete-form-{{ $digitized_card->id }}" action="{{ route('digitized_card.destroy', ['digitized_card' => $digitized_card]) }}"
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a class="float-md-right "
               href="{{route('digitized_card.edit',['digitized_card' => $digitized_card])}}"
               >
                Modifier
            </a>

            <dl>
                <dt>
                    PAN
                </dt>
                <dd>{{$digitized_card->pan->name}}</dd>
            </dl>
            <dl>
                <dt>
                    Device
                </dt>
                <dd>{{$digitized_card->device->name}}</dd>
            </dl>
            <dl>
                <dt>
                    Description
                </dt>
                <dd>
                    {{$digitized_card->description}}
                </dd>
            </dl>

        </div>
    </div>
</div>
