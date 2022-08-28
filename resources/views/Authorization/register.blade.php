<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>



    <form action="{{route('user.store')}}" method="post">

        @csrf

        @foreach($roles as $rol)
            <label for="rol_{{$rol->id}}">{{ $rol->rol }}</label>
            <input id="rol_{{$rol->id}}" type="radio" value="{{ $rol->id }}" name="rol" />
        @endforeach

        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <input type="submit">
    </form>


    
</body>
</html>