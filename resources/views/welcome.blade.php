<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body class="antialiased">

        <div class="d-flex justify-content-center align-items-center h-100 bg-light" style="min-height:100vh;">

            <form action="{{route('user.auth')}}" method="post" class="w-75" style="max-width:350px;">
                @csrf
                <div class="text-center text-muted mb-4 border-bottom border-info w-50 mx-auto">
                    <h5>Log in</h5>
                </div>
                <x-msg-error
                    class="mb-3"
                />
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email or Nick</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" aria-describedby="email-error">
                    <div id="email-error" class="form-text text-danger">{{ $errors->first('email') }}</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" aria-describedby="password-error">
                    <div id="password-error" class="form-text text-danger">{{ $errors->first('password') }}</div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-info text-white">Login</button>
                </div>
                
            </form>
        </div>

        <style>

            .curve-left,
            .curve-right{
                position: absolute;
                bottom:0;
                right:0;
                width: 500px;
                height:180px;
                background-color: #0dcaf0;
                border-radius: 100% 0 0 0;
            }

            .curve-right{
                top:0;
                left:0;
                border-radius: 0 0 100% 0;
            }
            #title{
                z-index:9;
                position: fixed;
                top:0;
                left: 0;
    
                width: 450px;
                text-align: center;
                padding-top: 10px;
            }
        </style>
        <h3 id="title" class="text-light">Simple System Inventory</h3>
        <div class="curve-left"></div>
        <div class="curve-right"></div>
    </body>
</html>
