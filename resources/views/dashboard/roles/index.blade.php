@extends('layouts.dashboard')

@section('content')
<style>
    table, tr{
        border:1px solid black;
    }
    td{
        padding:5px 10px;
    }

</style>
<br>
    
<div class="px-5 mx-auto mt-5">
 

  @can('create', \App\Models\Rol::class)
    <a href="{{route('rol.create')}}" class="btn btn-info text-white mb-3">Add rol</a>
  @endcan
 <table class="table table-striped border">
     <thead>
         <tr>
         <th scope="col">Rol</th>
         <th scope="col">Users</th>
         <th scope="col">Product</th>
         <th scope="col">Provider</th>
         <th scope="col">Category</th>
         <th scope="col">Rol</th>
         <th scope="col">User</th>
         <th scope="col">Actions</th>
         </tr>
     </thead>
     <tbody>
        @foreach($roles as $rol)
        
            <tr>
                <td>{{ $rol->rol }}</td>
                <td>{{ $rol->users->count() }}</td>
                <?php
                    $permissionBySection = [];
                ?>
                @foreach($rol->permissions as $permission)

                     @isset($permissionBySection[$permission->section->model])
                         <?php array_push($permissionBySection[$permission->section->model], $permission->action->action); ?>
                     @else
                         <?php
                             $permissionBySection[$permission->section->model] = [];
                            array_push($permissionBySection[$permission->section->model], $permission->action->action);   
                         ?>
                     @endisset

                @endforeach
                <td>
                    @isset($permissionBySection['App\Models\Product'])
                        @foreach($permissionBySection['App\Models\Product'] as $action)
                            {{ $action }}<br>
                        @endforeach
                    @else
                        @if($rol->rol === 'admin')
                            All
                        @else
                            Nothing
                        @endif
                    @endisset
                    
                </td>
                <td>
                    @isset($permissionBySection['App\Models\Provider'])
                        @foreach($permissionBySection['App\Models\Provider'] as $action)
                            {{ $action }}<br>
                        @endforeach
                        @else
                        @if($rol->rol === 'admin')
                            All
                        @else
                            Nothing
                        @endif
                    @endisset
                </td>
                <td>
                    @isset($permissionBySection['App\Models\Category'])
                        @foreach($permissionBySection['App\Models\Category'] as $action)
                            {{ $action }}<br>
                        @endforeach
                        @else
                        @if($rol->rol === 'admin')
                            All
                        @else
                            Nothing
                        @endif
                    @endisset
                </td>
                <td>
                    @isset($permissionBySection['App\Models\Rol'])
                        @foreach($permissionBySection['App\Models\Rol'] as $action)
                            {{ $action }}<br>
                        @endforeach
                        @else
                        @if($rol->rol === 'admin')
                            All
                        @else
                            Nothing
                        @endif
                    @endisset
                </td>
                <td>
                    @isset($permissionBySection['App\Models\User'])
                        @foreach($permissionBySection['App\Models\User'] as $action)
                            {{ $action }}<br>
                        @endforeach
                        @else
                        @if($rol->rol === 'admin')
                            All
                        @else
                            Nothing
                        @endif
                    @endisset
                </td>
                <td>
                    @can('destroy', $rol)
                            <button class="bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#remove-rol-{{ $rol->id}}"><i class="bi bi-trash"></i></button>
                            
                            <div class="modal fade" id="remove-rol-{{ $rol->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you want to remove this rol?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('rol.destroy') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="rol" value="{{ $rol->id }}" >
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