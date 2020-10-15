<div class="card">
    <div
        class="card-header @if(isset($loop_iter) &&  $loop_iter% 2 == 0)bg-secondary @else bg-primary @endif text-white">
        <span>{{$pan->name}}</span>
        <a class="float-md-right text-white"
           href="{{route('pan.destroy',['pan' => $pan])}}"
           onclick="event.preventDefault();
               document.getElementById('delete-form-{{ $pan->id }}').submit();">
            X
        </a>

        <form id="delete-form-{{ $pan->id }}" action="{{ route('pan.destroy', ['pan' => $pan]) }}"
              method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    <div class="card-body">
        <div class="card-text">
            <a class="float-md-right "
               href="{{route('pan.edit',['pan' => $pan])}}"
            >
                Modifier
            </a>
            <dl>
                <dt>
                    Pan
                </dt>
                <dd>{{$pan->pan}}</dd>
            </dl>
            <dl>
                <dt>
                    Description
                </dt>
                <dd>
                    {{$pan->description}}
                </dd>
            </dl>
            <div class="dropdown float-md-right">
                <button class="btn btn-success dropdown-toggle" type="button"
                        id="dropdown-digitized-cards-pan-{{$pan->id}}" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    Digitized Cards
                </button>
                <div id="digitized-cards-list-for-{{ $pan->id }}" class="dropdown-menu">
                    @foreach($pan->digitized_cards as $dc)
                        <a class="dropdown-item"
                           href="{{route('digitized_card.show',['digitized_card'=>$dc])}}">{{$dc->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
