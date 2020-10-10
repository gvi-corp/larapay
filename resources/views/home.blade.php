@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @auth()
                            <p>
                                {{ ucfirst(__('hi'))}} {{auth()->user()->name}} {{'!'}}
                            </p>

                            <p>
                                <a href="{{route('pan.create')}}">Register a PAN</a>
                            </p>

                            <h2>Current registered PANs</h2>
                            @foreach(auth()->user()->pans as $pan)
                                <p>
                                    @include('pan.partial.show',['pan' => $pan])
                                </p>
                            @endforeach

                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
