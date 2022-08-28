@extends('layouts.dashboard')

@section('content')

<div class="px-5 mx-auto mt-5">

         @can('create', \App\Models\Provider::class)
            <a href="{{route('provider.create')}}" class="btn btn-info text-white mb-3"> Add provider</a>
         @endcan
        <table class="table table-striped border">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Gmail</th>
                <th scope="col">Location</th>
                <th scope="col">Products</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($providers as $provider)
                    <tr>
                        <td>{{ $provider->name }}</td>
                        <td>{{ $provider->phone }}</td>
                        <td>{{ $provider->gmail }}</td>
                        <td>{{ $provider->location }}</td>
                        <td> {{ $provider->products->count() }} </td>
                        <td> 
                            @can('destroy', $provider)
                                <button class="bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#remove-provider{{$provider->id}}"><i class="bi bi-trash"></i></button>
                            
                                <div class="modal fade" id="remove-provider{{$provider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Do you want to remove this provider?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>If this provider is deleted, all products from this provider will also be deleted</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('provider.destroy') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="providerId" value="{{ $provider->id }}" >
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
    {{ $providers->links('vendor.pagination.bootstrap-5') }}
@endsection('content')