@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @include('digitized_card.partial.show',['digitized_card' => $digitized_card])
    </div>
@endsection
