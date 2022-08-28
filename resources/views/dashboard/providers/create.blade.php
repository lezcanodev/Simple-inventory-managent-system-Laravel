@extends('layouts.dashboard')

@section('content')

    <div class="my-5">

            <div class="w-50 mx-auto">
                <x-msg-success />
            </div>

        <form action="{{route('provider.store')}}" method="post" class="form w-50 mx-auto d-grid gap-2">
            <h4 class="text-muted h6"><a href="{{ route('provider.index') }}">Go to providers</a> </h4>

            @csrf
            <input type="hidden" name="user" value="{{ Auth::user()->id }}">

            <x-form-input
                label="Name"
                name="name"
            />

            <x-form-input
                label="Phone"
                name="phone"
            />

            <x-form-input
                label="Email"
                name="email"
            />

            <x-form-input
                label="Location"
                name="location"
            />

            <div>
                <label for="" class="mb-2">Categories</label>
                <div class="d-flex flex-wrap gap-2">
                
                    @foreach($categories as $category)
                    <div>
                        <input type="checkbox" id="category_{{ $category->id }}" value="{{ $category->id}}" name="categories[]">
                        <label for="category_{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                        
                    @endforeach
                </div>
            </div>



            <div class="text-end">
                 <button type="submit" class="btn btn-info text-white">Add</button>
            </div>
           
        </form>

    </div>

@endsection('content')