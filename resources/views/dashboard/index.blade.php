@extends('layouts.dashboard')

@section('content')

    <div class="my-5 w-75 mx-auto">
        <div class="d-flex justify-content-between gap-3">
            <div class="text-center bg-info text-white w-50 p-4 border rounded">
                <div class="fs-1">
                    {{ \App\Models\Product::select('id')->get()->count() }}
                </div>
                <div class="fs-5">
                    <span> <i class="bi bi-boxes"></i>  Products</span>
                </div>
            </div>

            <div class="text-center bg-success text-white w-50 p-4 border rounded">
                <div class="fs-1">
                    {{ \App\Models\Provider::select('id')->get()->count() }}
                </div>
                <div class="fs-5">
                    <span> <i class="bi bi-truck"></i>  Providers</span>
                </div>
            </div>

            
            <div class="text-center bg-primary text-white w-50 p-4 border rounded">
                <div class="fs-1">
                    {{ \App\Models\User::select('id')->get()->count() }}
                </div>
                <div class="fs-5">
                    <span> <i class="bi bi-perople"></i>  Users</span>
                </div>
            </div>

        </div>

        <div class="mt-5">
            <h3>Sections</h3>
            <div>
                <div class="d-flex justify-content-between gap-3">
                    @can('view', \App\Models\Product::class )
                        <a href="{{ route('product.index') }}" class="btn  btn-outline-info text-center border-info w-50 p-4 border rounded">
                            <div class="fs-1">
                            <i class="bi bi-boxes"></i>
                            </div>
                            <div class="fs-5">
                                Products</span>
                            </div>
                        </a >
                    @endcan

                    @can('view', \App\Models\Provider::class )
                        <a href="{{ route('provider.index') }}" class="btn  btn-outline-info text-center border-info w-50 p-4 border rounded">
                            <div class="fs-1">
                            <i class="bi bi-truck"></i>
                            </div>
                            <div class="fs-5">
                                Providers</span>
                            </div>
                        </a >
                    @endcan

                    
                    @can('view', \App\Models\Category::class )
                        <a href="{{ route('category.index') }}" class="btn  btn-outline-info text-center border-info w-50 p-4 border rounded">
                            <div class="fs-1">
                            <i class="bi bi-tag"></i>
                            </div>
                            <div class="fs-5">
                                Categories</span>
                            </div>
                        </a >
                    @endcan

                    @can('view', \App\Models\User::class )
                        <a href="{{ route('user.index') }}" class="btn  btn-outline-info text-center border-info w-50 p-4 border rounded">
                            <div class="fs-1">
                            <i class="bi bi-people"></i>
                            </div>
                            <div class="fs-5">
                                Users</span>
                            </div>
                        </a >
                     @endcan

                     @can('view', \App\Models\Rol::class )
                        <a href="{{ route('rol.index') }}" class="btn  btn-outline-info text-center border-info w-50 p-4 border rounded">
                            <div class="fs-1">
                            <i class="bi bi-layers"></i>
                            </div>
                            <div class="fs-5">
                                Roles</span>
                            </div>
                        </a >
                     @endcan

                </div>
            </div>
        </div>

    </div>


@endsection('content')