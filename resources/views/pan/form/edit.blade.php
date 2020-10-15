@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit PAN !</h1>
                <form action="{{route('pan.update',['pan' => $pan])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="pan-pan">Primary Account Number</label>
                        <input type="text" class="form-control" id="pan-pan" aria-describedby="pan"
                               name="pan"
                               placeholder="Enter your Primary Account Number"
                               value="{{$pan->pan}}"
                               maxlength="16">
                        @error('pan_pan')
                        <small id="pan_error"
                               class="form-text text-muted alert-danger">{{$errors->first('pan_pan')}}</small>
                        @enderror

                        <label for="pan-name">PAN Name</label>
                        <input type="text" class="form-control" id="pan-name" aria-describedby="pan-name"
                               name="name"
                               placeholder="Enter PAN Name"
                               value="{{$pan->name}}">
                        @error('pan_name')
                        <small id="pan_name_error"
                               class="form-text text-muted alert-danger">{{$errors->first('pan_name')}}</small>
                        @enderror


                        <label for="pan-desc">PAN description</label>
                        <textarea class="form-control" id="pan-desc" aria-describedby="pan_desc"
                                  name="description"
                                  placeholder="Enter your PAN Description"
                        >{{$pan->description}}</textarea>
                        @error('description')
                        <small id="pan_desc_error"
                               class="form-text text-muted alert-danger">{{$errors->first('description')}}</small>
                        @enderror

                        @if($errors->any())
                        @endif

                        <input type="submit" value="Update">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
