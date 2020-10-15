@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1>My 10 latest payments</h1>
        @include('payment.partial.index',['payments' => auth()->user()->payments()->latest()->take(10)->get()])
    </div>
@endsection
