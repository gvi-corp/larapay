@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('pan.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="pan-pan">Primary Account Number</label>
                        <input type="text" class="form-control" id="pan-pan" aria-describedby="pan"
                               name="pan"
                               placeholder="Enter your Primary Account Number"
                               maxlength="16">
                        @error('pan')
                        <small id="pan_error" class="form-text text-muted alert-danger">{{$errors->first('pan')}}</small>
                        @enderror

                        <label for="pan-name">PAN Name</label>
                        <input type="text" class="form-control" id="pan-name" aria-describedby="pan-name"
                               name="name"
                               placeholder="Enter PAN Name"
                        >
                        @error('name')
                        <small id="pan_name_error" class="form-text text-muted alert-danger">{{$errors->first('name')}}</small>
                        @enderror

                        <label for="pan-desc">PAN description</label>
                        <textarea class="form-control" id="pan-desc" aria-describedby="pan_desc"
                                  name="description"
                                  placeholder="Enter your PAN Description"
                        >
                        </textarea>
                        @error('description')
                        <small id="pan_desc_error"
                               class="form-text text-muted alert-danger">{{$errors->first('description')}}</small>
                        @enderror

                        <input type="submit" value="Submit">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
