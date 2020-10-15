@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1>My digitized cards</h1>
        @include('digitized_card.partial.index')
    </div>
@endsection
