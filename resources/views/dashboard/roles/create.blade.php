@extends('layouts.dashboard')

@section('content')
        <div class="my-5">

            <div class="w-50 mx-auto">
                <x-msg-success />
            </div>

      
        <form action="{{route('rol.store')}}" method="post" class="form w-50 mx-auto d-grid gap-2">
            
        <a href="{{ route('rol.index') }}">Go to roles</a> 
            @csrf

            <x-form-input
                label="Name"
                name="name"
            />
            
            <div>
                <h5>Assing actions for each section</h5>
                <div class="container">
                
                    @foreach($sections as $section)
                    <div class="mb-2">
                        <label for="category_" class="">{{ explode("\\",$section->model)[2] }}</label>
                        <div class="d-flex flex-column  container">
                            @foreach($actions as $action)
                                <div>
                                    <input type="checkbox" id="action_{{$action->id.$section->id}}" value="{{$action->id}}" name="section[{{$section->id}}][]">
                                    <label for="action_{{$action->id.$section->id}}" class="">{{ $action->action }}</label>
                                </div>

                            @endforeach
                        </div>
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