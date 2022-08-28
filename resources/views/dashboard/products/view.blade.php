@extends('layouts.dashboard')

@section('content')

    <div class="w-75 mx-auto my-5">
                <div  class="mb-3">
                    <h2>{{$product->name}}</h2>
                    <span class="d-block text-muted">Provider: {{$product->provider->name}}</span>
                    <span class="d-block text-muted">Category: {{$product->category->name}}</span>
                    <span class="d-block text-muted ">Published: {{$product->created_at?->diffForHumans()}}</span>
                    <span class="d-block text-muted">Modified: {{$product->updated_at?->diffForHumans()}}</span>
                    <span class="d-block text-muted">Published by user: {{$product->user->name}}</span>
                </div>
                
                
           
                <div class="d-flex flex-wrap justify-content-around">
                
                    @if(Storage::disk('products')->exists($product->id))
                        @foreach (Storage::disk('products')->files($product->id) as $image)
                          <img src="{{Storage::disk('products')->url($image)}}" alt="fail" width="200">
                        @endforeach
                    @endif
                       
                </div>
                <div>
                    <div class="fs-5 d-flex flex-wrap align-content-center justify-content-around my-5 text-center bg-light p-3 border rounded">
                        <div>
                            <p class="fw-bold">Stock</p>
                            <p>{{$product->stock}}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Sales Price</p>
                            <p>{{$product->sale_price}}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Purchase Price</p>
                            <p>{{$product->purchase_price}}</p>
                        </div>
                    </div>

                    <div>
                        <p class="fw-bold">Description</p>
                        <p>{{$product->description}}</p>
                    </div>
                </div>
            </div>
    </div>
@endsection