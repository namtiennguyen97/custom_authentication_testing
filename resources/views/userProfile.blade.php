<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome {{$user->name}}</title>
    @include('cdn')
</head>
<body>
{{--{{\Illuminate\Support\Facades\Session::get('logged')->id}}--}}
Welcome {{$user->name}} Dashboard
<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>Your ID:</th>
        <th>Name</th>
        <th>Email</th>

    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
    </tr>
    </tbody>
</table>
<form method="post" action="{{route('user.logout')}}">
    @csrf
    <button class="btn btn-primary" type="submit">Logout</button>
</form>
<a class="btn btn-primary" href="{{route('index')}}">Return to main Page</a>
</body>
</html>
