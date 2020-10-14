@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Edit Device !</h1>
                <form action="{{route('digitized_card.update',['digitized_card' => $digitized_card])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="digitized-card-name">Digitized Card Name</label>
                        <input type="text" class="form-control" id="digitized-card-name"
                               aria-describedby="digitized-card-name"
                               name="name"
                               value="{{$digitized_card->name}}"
                               placeholder="Enter your Digitized Card Name"
                        >
                        @error('name')
                        <small id="digitized-card-name-error"
                               class="form-text text-muted alert-danger">{{$errors->first('name')}}</small>
                        @enderror

                        <label for="digitized-card-pan">Choose which PAN to digitize : </label>
                        <select type="text" class="form-control" id="digitized-card-pan"
                                aria-describedby="digitized-card-pan"
                                name="pan_id">
                            @foreach(@auth()->user()->pans as $pan)
                                <option value="{{$pan->id}}" @if($loop->first) selected="selected" @endif
                                    {{-- title="{{$pan->PAN}}"--}}
                                >
                                    {{$pan->name}} ({{$pan->PAN}})
                                </option>>
                            @endforeach
                        </select>
                        @error('pan_id')
                        <small id="digitized-card-os-error"
                               class="form-text text-muted alert-danger">{{$errors->first('pan_id')}}</small>
                        @enderror


                        <label for="digitized-card-digitized_card">Choose on which digitized_card : </label>
                        <select type="text" class="form-control" id="digitized-card-digitized_card"
                                aria-describedby="digitized-card-digitized_card"
                                name="digitized_card_id">
                            @foreach(@auth()->user()->digitized_cards as $digitized_card)
                                <option value="{{$digitized_card->id}}" @if($loop->first) selected="selected" @endif>
                                    {{$digitized_card->name}} ({{$digitized_card->type}} - {{$digitized_card->os}})
                                </option>>
                            @endforeach
                        </select>
                        @error('pan_id')
                        <small id="digitized-card-os-error"
                               class="form-text text-muted alert-danger">{{$errors->first('digitized_card_id')}}</small>
                        @enderror


                        <label for="digitized-card-desc">Description</label>
                        <textarea class="form-control" id="digitized-card-desc" aria-describedby="digitized-card-desc"
                                  name="description"
                                  placeholder="Enter your Digitized Card Description"
                        >{{
    $digitized_card->description
                        }}</textarea>
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
