@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('pan.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="pan">Primary Account Number</label>
                        <input type="text" class="form-control" id="pan" aria-describedby="pan"
                               name="pan"
                               placeholder="Enter your Primary Account Number"
                               maxlength="16">
                        @if($errors->any())
                        <small id="pan_error" class="form-text text-muted alert-danger">{{$errors->first('pan')}}</small>
                        @endif

                        <input type="submit" value="Submit">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
