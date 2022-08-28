@extends('layouts.dashboard')

@section('content')

    
   @if($selectedProvider)
        <div class="my-5">
            <div class="w-50 mx-auto">
                <x-msg-success />
            </div>
         

            <form action="{{route('product.store')}}" method="post" class="form w-50 mx-auto d-grid gap-2" enctype="multipart/form-data">
                <h4 class="text-muted h6"><a href="{{ route('product.index') }}">Go to products</a> </h4>
                <h4 class="text-muted h6"> Provider: {{ $providers->name }} <a href="{{ route('product.create') }}">Change</a> </h4>
    
                @csrf

                <input type="hidden" name="provider" value="{{ $providers->id }}">
                <input type="file" multiple name="imgs[]">
                
                <x-form-input
                    class="mb-1"
                    label="Name"
                    name="name"
                />

                <x-form-input
                    class="mb-1"
                    label="Stock"
                    name="stock"
                    type="number"
                />

                <x-form-input
                    class="mb-1"
                    label="Sale Price"
                    name="sale_price"
                />

                <x-form-input
                    class="mb-1"
                    label="Purchase Price"
                    name="pruchase_price"
                />
              



                <div class="mb-1">
                    <label for="email" class="form-label">Categories</label>
                    
                    <select class="form-select" name="category" aria-describedby="category-error">
                            @foreach($providers->categories as $itr)
                                <option value="{{$itr->id}}">{{$itr->name}}</option>
                            @endforeach
                    </select>

                    <div id="category-error" class="form-text text-danger">{{ $errors->first('category') }}</div>
                </div>

                <x-form-textarea
                    class="mb-1"
                    label="Description"
                    name="description"
                    :iterable="$providers->categories"
                />

                <div class="text-end">
                    <button type="submit"  class="btn btn-info text-white">Add</button>
                </div>
            
            </form>
        </div>
     @else
        
        <div class="d-grid gap-2 mt-5 w-50 mx-auto">
            <h3>Select a provider</h3>
            @foreach($providers as $provider)
                <a href="{{ route('product.create', [$provider->id]) }}">{{ $provider->name }}</a>
            @endforeach
        </div>

     @endif
@endsection('content')