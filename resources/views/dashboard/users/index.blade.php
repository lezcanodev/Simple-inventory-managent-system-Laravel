@extends('layouts.dashboard')

@section('content')
    <div class="px-5 mx-auto mt-5">
         @can('create', \App\Models\User::class)
            <a href="{{ route('user.create') }}" class="btn btn-info text-white mb-3">Add user</a>
        @endcan
        <table class="table table-striped border">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Rol</th>
                <th scope="col">Email</th>
                <th scope="col">Email verified</th>
                <th scope="col">Products</th>
                <th scope="col">Providers</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->rol->rol }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ empty($user->email_verified_at) ? 'No' : $user->email_verified_at->diffForHumans() }}</td>
                        <td>{{ $user->products->count()  }}</td>
                        <td> {{ $user->providers->count() }} </td>
                        <td> 
                            @can('destroy', $user)
                                <button class="bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#remove-user-{{ $user->id}}"><i class="bi bi-trash"></i></button>
                                
                                <div class="modal fade" id="remove-user-{{ $user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Do you want to remove this user?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <p>If this user is deleted, all products and providers from this user will also be deleted</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('user.destroy') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="user" value="{{ $user->id }}" >
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