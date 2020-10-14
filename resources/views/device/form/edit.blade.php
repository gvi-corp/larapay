@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Device !</h1>
                <form action="{{route('device.update',['device' => $device])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="device-name">Device Name</label>
                        <input type="text" class="form-control" id="device-name" aria-describedby="device-name"
                               name="name"
                               placeholder="Enter Device Name"
                               value="{{$device->name}}"
                        >
                        @error('name')
                        <small id="device-name-error"
                               class="form-text text-muted alert-danger">{{$errors->first('name')}}</small>
                        @enderror

                        <label for="device-type">Device Type</label>
                        <select type="text" class="form-control" id="device-type" aria-describedby="device-type"
                                name="type">
                            @foreach(['Smartphone','Tablet','Watch','Other'] as $type)
                                <option value="{{$type}}" @if($type == $device->type) selected="selected" @endif>
                                    {{$type}}
                                </option>>
                            @endforeach
                        </select>
                        @error('type')
                        <small id="device-type-error"
                               class="form-text text-muted alert-danger">{{$errors->first('type')}}</small>
                        @enderror

                        <label for="device-os">Device Operating System</label>
                        <select type="text" class="form-control" id="device-os" aria-describedby="device-os"
                                name="os">
                            @foreach(['Android','iOS','Other'] as $os)
                                <option value="{{$os}}" @if($os == $device->os) selected="selected" @endif>
                                    {{$os}}
                                </option>>
                            @endforeach
                        </select>
                        @error('os')
                        <small id="device-os-error"
                               class="form-text text-muted alert-danger">{{$errors->first('os')}}</small>
                        @enderror

                        <label for="device-desc">Device description</label>
                        <textarea class="form-control" id="device-desc" aria-describedby="device_desc"
                                  name="description"
                                  placeholder="Enter your Device Description"
                        >{{
    $device->description
                        }}</textarea>
                        @error('description')
                        <small id="device-desc-error"
                               class="form-text text-muted alert-danger">{{$errors->first('device_desc')}}</small>
                        @enderror


                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
