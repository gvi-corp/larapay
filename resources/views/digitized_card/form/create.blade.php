@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('digitized_card.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="digitized-card-name">Digitized Card Name</label>
                        <input type="text" class="form-control" id="digitized-card-name" aria-describedby="digitized-card-name"
                               name="name"
                               placeholder="Enter your Digitized Card Name"
                        >
                        @error('name')
                        <small id="digitized-card-name-error"
                               class="form-text text-muted alert-danger">{{$errors->first('name')}}</small>
                        @enderror

                        <label for="digitized-card-pan">Choose which PAN to digitize : </label>
                        <select type="text" class="form-control" id="digitized-card-pan" aria-describedby="digitized-card-pan"
                                name="pan_id">
                            @foreach(@auth()->user()->pans as $pan)
                                <option value="{{$pan->id}}" @if($loop->first) selected="selected" @endif
                                {{-- title="{{$pan->pan}}"--}}
                                >
                                    {{$pan->name}} ({{$pan->pan}})
                                </option>>
                            @endforeach
                        </select>
                        @error('pan_id')
                        <small id="digitized-card-os-error"
                               class="form-text text-muted alert-danger">{{$errors->first('pan_id')}}</small>
                        @enderror


                        <label for="digitized-card-device">Choose on which device : </label>
                        <select type="text" class="form-control" id="digitized-card-device" aria-describedby="digitized-card-device"
                                name="device_id">
                            @foreach(@auth()->user()->devices as $device)
                                <option value="{{$device->id}}" @if($loop->first) selected="selected" @endif>
                                    {{$device->name}} ({{$device->type}} - {{$device->os}})
                                </option>>
                            @endforeach
                        </select>
                        @error('pan_id')
                        <small id="digitized-card-os-error"
                               class="form-text text-muted alert-danger">{{$errors->first('device_id')}}</small>
                        @enderror


                        <label for="digitized-card-desc">Description</label>
                        <textarea class="form-control" id="digitized-card-desc" aria-describedby="digitized-card-desc"
                                  name="description"
                                  placeholder="Enter your Digitized Card Description"
                                  >
                        </textarea>
                        @error('description')
                        <small id="digitized-card-desc-error"
                               class="form-text text-muted alert-danger">{{$errors->first('digitized_card_desc')}}</small>
                        @enderror


                        <input type="submit" value="Submit">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
