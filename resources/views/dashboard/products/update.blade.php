@extends('layouts.dashboard')

@section('content')

    <div class="my-5">
                <div class="w-50 mx-auto">
                <x-msg-success />
            </div>
            
        <form action="{{route('product.updated')}}" method="post" class="form w-50 mx-auto d-grid gap-2" enctype="multipart/form-data">
            <h4 class="text-muted h6"><a href="{{ route('product.index') }}">Go to products</a> </h4>
           
            @method('PUT')
            @csrf
            <input type="hidden" name="product" value="{{ $product->id }}">
            @can('update', $product)
                <input type="hidden" name="user" value="{{ $product->user->id }}">
            @endcan
            <input type="hidden" name="provider" value="{{ $providers->id }}">
            <input type="file" multiple name="imgs[]">
            <x-form-input
                    class="mb-1"
                    label="Name"
                    name="name"
                    value="{{$product->name }}"
            />

            <x-form-input
                    class="mb-1"
                    label="Stock"
                    name="stock"
                    type="number"
                    value="{{$product->stock }}"
            />

            <x-form-input
                    class="mb-1"
                    label="Sale Price"
                    name="sale_price"
                    value="{{$product->sale_price }}"
            />

            <x-form-input
                    class="mb-1"
                    label="Purchase Price"
                    name="pruchase_price"
                    value="{{$product->purchase_price }}"
            />



            <div class="mb-1">
                    <label  class="d-block form-label">Categories</label>
                    

                    <select name="category" class="form-select" aria-describedby="category-error">
                        <option value="" disabled selected >Categories</option>
                        @foreach($providers->categories as $category)
                            @if($product->category->id === $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                            @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                    
                        @endforeach
                    </select>

                    <div id="category-error" class="form-text text-danger">{{ $errors->first('category') }}</div>
            </div>

            
            <x-form-textarea
                    class="mb-1"
                    label="Description"
                    name="description"
                    value="{{$product->description}}"
            />

            <div class="text-end ">
                <button type="submit" class="btn btn-info text-white">Submit</button>
            </div>
          
        </form>
        
        </div>
@endsection('content')