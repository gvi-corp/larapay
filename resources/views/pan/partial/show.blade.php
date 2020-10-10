<div class="card">
    <div class="card-header bg-primary text-white">
        <span>{{$pan->PAN}}</span>
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
            {{$pan->PAN}}
        </div>
    </div>
</div>
