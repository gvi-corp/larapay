@extends('layouts.app')

@section('content')
    <div class="container">
        @include('pan.partial.show',['pan' => $pan])
    </div>
@endsection
