@extends('layouts.dashboard')

@section('content')
    <div class="my-5">
    
            <div class="w-50 mx-auto">
                <x-msg-success />
            </div>

        <form action="{{route('user.store')}}" method="post" class="form w-50 mx-auto d-grid gap-2">
            <h4 class="text-muted h6"><a href="{{ route('user.index') }}">Go to users</a> </h4>
            @csrf
            <div>
                <label for="">Rol</label>
                <div class="d-flex flex-wrap gap-4">
                        @foreach($roles as $rol)
                            <div>
                                <label for="rol_{{$rol->id}}">{{ $rol->rol }}</label>
                                <input id="rol_{{$rol->id}}" type="radio" value="{{ $rol->id }}" name="rol" aria-describedby="rol-error" />
                            </div>
                        @endforeach
                </div>
                <div id="rol-error" class="form-text text-danger">{{ $errors->first('rol') }}</div>
            </div>

            <x-form-input
                label="Name"
                name="name"
            />

            <x-form-input
                label="Email"
                name="email"
            />

            <x-form-input
                label="Password"
                name="password"
                type="password"
            />

            <div class="text-end">
                 <button type="submit" class="btn btn-info text-white">Add</button>
            </div>
        </form>

    </div>
@endsection('content')