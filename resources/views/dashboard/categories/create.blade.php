@extends('layouts.dashboard')

@section('content')

    <div class="my-5">

            <div class="w-50 mx-auto">
                <x-msg-success />
            </div>

        <form action="{{route('category.store')}}" method="post" class="form w-50 mx-auto d-grid gap-2">
            <h4 class="text-muted h6"><a href="{{ route('category.index') }}">Go to categories</a> </h4>
            
            @csrf

            <x-form-input
                label="Name"
                name="name"
            />

            <div class="text-end">
                 <button type="submit" class="btn btn-info text-white">Add</button>
            </div>
           
        </form>

    </div>

@endsection('content')

