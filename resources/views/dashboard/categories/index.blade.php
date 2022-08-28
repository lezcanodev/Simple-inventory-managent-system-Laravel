@extends('layouts.dashboard')

@section('content')


<div class="px-5 mx-auto mt-5">
    @can('create', \App\Models\Category::class)
        <a href="{{ route('category.create') }}" class="btn btn-info text-white mb-3">Add Category</a>
    @endcan
    <table class="table table-striped border">
        <thead>
            <tr>
            <th scope="col">Category</th>
            <th scope="col">Providers</th>
            <th scope="col">Products</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->providers->count()}}</td>
                    <td>{{$category->products->count()}}</td>
                    <td class="d-flex justify-content-around">
                        @can('update', $category)                            
                            <a href="{{ route('category.update', [$category->id]) }}"><i class="bi bi-pencil text-info"></i></a>  
                        @endcan

                        @can('destroy', $category)  
                            <button class="bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#remove-category{{$category->id}}"><i class="bi bi-trash"></i></button>
                            
                            <div class="modal fade" id="remove-category{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to remove this category?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <p>If this category is deleted, all products from this category will also be deleted</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('category.destroy') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="category" value="{{ $category->id }}" >
                                            <button class="btn btn-primary">Delete</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection('content')