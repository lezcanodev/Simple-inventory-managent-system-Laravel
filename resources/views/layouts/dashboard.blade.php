<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body>
  
    <div id="dashboard" class="d-flex">
        <aside id="aside" class="bg-light border-end" style="width:300px; height:100vh;">
            <div class="text-center w-100 mb-3 px-5 border-bottom rounded border-info">
                <div class="">
                    <i class="bi bi-person fs-1 text-muted"></i>
                </div>
                <div class="text-muted">
                    <h5>{{ Auth::user()->name }}</h5>
                </div>
            </div>
            <div class="d-flex flex-column py-2 justify-content-between ">
                <a href="{{route('dashboard')}}" class="@if(request()->is('dashboard/*','dashboard')) bg-info text-white @endif  px-5 py-3 w-100 text-decoration-none">
                    <i class="bi bi-speedometer2"></i>
                    <span class="px-2">Home</span>
                </a>
                @can('view', \App\Models\Product::class)
                    <a href="{{route('product.index')}}" class="@if(request()->is('products/*','products')) bg-info text-white @endif px-5 py-3 w-100 text-decoration-none">
                        <i class="bi bi-boxes"></i>
                        <span class="px-2">Products</span>
                    </a>
                @endcan

                @can('view', \App\Models\Provider::class)
                    <a href="{{route('provider.index')}}" class="@if(request()->is('providers/*','providers')) bg-info text-white @endif px-5 py-3 w-100 text-decoration-none">
                        <i class="bi bi-truck"></i>
                        <span class="px-2">Providers</span>
                    </a>
                @endcan

                @can('view', \App\Models\Category::class)
                    <a href="{{route('category.index')}}" class="@if(request()->is('categories/*','categories')) bg-info text-white @endif px-5 py-3 w-100 text-decoration-none">
                        <i class="bi bi-tag"></i>
                        <span class="px-2">Categories</span>
                    </a>
                @endcan

                @can('view', \App\Models\User::class)
                    <a href="{{route('user.index')}}" class="@if(request()->is('users/*', 'users')) bg-info text-white @endif px-5 py-3 w-100 text-decoration-none">
                        <i class="bi bi-people"></i>
                        <span class="px-2">Users</span>
                    </a>
                @endcan

                @can('view', \App\Models\Rol::class)
                <a href="{{route('rol.index')}}" class="@if(request()->is('roles/*', 'roles')) bg-info text-white @endif px-5 py-3 w-100 text-decoration-none">
                    <i class="bi bi-layers"></i>
                    <span class="px-2">Roles</span>
                </a>
                @endcan

            </div>
            <div class="text-center mt-5">
                <a href="{{route('user.logout')}}">
                    <i class="bi bi-box-arrow-left"></i>  
                    Log out
                </a>
            </div>
           
        </aside>

        <div class="w-100" style="height:100vh; overflow-y:scroll;"> 
            @yield('content')
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>