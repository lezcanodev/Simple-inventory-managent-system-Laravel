@extends('layouts.dashboard')

@section('content')


<div class="px-5 mx-auto mt-5">
 
    <form class="mb-5 w-75 mx-auto bg-light p-3 border rounded" method="GET">
        <div>
            <label for="">Search</label>
            <input type="text" class="w-100" placeholder="Search..." value="{{!(request()->has('search')) ?'': request()->search }}" name="search">
        </div>
        
        <div class="d-flex flex-wrap gap-2 justify-content-between mt-2">
            <div >
                <label for="" class="d-block">Order by</label>
                <select name="order" id="">
                    <option value=""></option>
                    <option value="orderby_stock" {{ !(request()->has('order') && request()->order == 'orderby_stock') ?: 'selected' }} > Stock</option>
                    <option value="orderby_price" {{ !(request()->has('order') && request()->order == 'orderby_price') ?: 'selected' }}> Price</option>
                </select>
            </div>

            <div>
                <label for="" class="d-block">Categories</label>
                <select name="category" id="">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        @if(request()->has('category') && request()->category == $category->id)
                            <option value="{{$category->id}}" selected> {{$category->name}} </option>
                        @else
                            <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label for="" class="d-block">Providers</label>
                <select name="provider" id="">
                    <option value="">All</option>
                    @foreach($providers as $provider)
                        @if(request()->has('provider') && request()->provider == $provider->id)
                            <option value="{{$provider->id}}" selected> {{$provider->name}} </option>
                        @else
                            <option value="{{$provider->id}}"> {{$provider->name}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div>
                <label for="" class="d-block">Users</label>
                <select name="user" id="">
                    <option value="">All</option>
                    @foreach($users as $user)
                        @if(request()->has('user') && request()->user == $user->id)
                            <option value="{{$user->id}}" selected> {{$user->name}} </option>
                        @else
                            <option value="{{$user->id}}"> {{$user->name}} </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="text-end">
            <input type="submit" class="btn btn-info text-white mt-3" value="Apply filters">
        </div>
       
    </form>

     @can('create', \App\Models\Product::class)
        <a href="{{route('product.create')}}" class="btn btn-info text-white mb-3">Add product</a>
    @endcan
    <table class="table table-striped border">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Sale Price</th>
            <th scope="col">Provider</th>
            <th scope="col">Category</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>{{ $product->provider->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td class="d-flex justify-content-between"> 
                            <a href="{{ route('product.view', $product->id) }}"><i class="bi bi-eye text-primary"></i></a>  
                        @can('update', $product)
                             <a href="{{ route('product.update', [$product->id]) }}"><i class="bi bi-pencil text-info"></i></a>  
                        @endcan
                        @can('destroy', $product)
                            <button class="bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#remove-product-{{ $product->id}}"><i class="bi bi-trash"></i></button>
                            
                            <div class="modal fade" id="remove-product-{{ $product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to remove this product?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('product.destroy') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="productId" value="{{ $product->id }}" >
                                            <button class="btn btn-primary">Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    
                </tr>
            @endforeach
        </tbody>
    </table>




    {{ $products->appends(request()->all())->links('vendor.pagination.bootstrap-5') }}
</div>
@endsection('content')