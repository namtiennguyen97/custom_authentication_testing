<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Data</title>
    @include('cdn')

</head>
<body>
<div style="background-color: #8aafd7;height: 60px">
    @if(\Illuminate\Support\Facades\Session::has('logged'))
        <div>
            <div class="dropdown">
                @if($user->image == NULL)
                    <img src="{{asset('001-fix.jpg')}}" width="50" style="height: 50px; width: 50px;position: absolute;top: 8px;right: 16px" class="img img-thumbnail dropdown-toggle" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false" alt="Avatar">
                @else
                    <img src="{{asset('storage/'.$user->image)}}" width="50" style="height: 50px; width: 50px" class="img img-thumbnail  dropdown-toggle" id="avatarDropdown" data-bs-toggle="dropdown" aria-expanded="false" alt="Avatar">
                @endif
                <ul class="dropdown-menu" aria-labelledby="avatarDropdown">
                    <li><a class="dropdown-item" href="{{route('user.profile')}}"><span class="btn btn-success">{{$user->name}} DashBoard <i class="fa fa-user"></i></span></a></li>
                    <li><a class="dropdown-item" href="#"><form method="post" action="{{route('user.logout')}}">
                                @csrf
                                <button type="submit" class="btn btn-danger form-control">Logout  <i class="fa fa-sign-out-alt"></i></button>
                            </form></a></li>
                    {{--                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                </ul>
            </div>

        </div>
    @endif

    <h1 align="center">User total data: <b>{{count(\App\Models\User::all())}}</b>
        <button id="showUserData" class="btn btn-warning">Show <i class="fa fa-eye"></i></button>
        @if(\Illuminate\Support\Facades\Session::has('logged'))
            {{--        <span class="text-success valid">You has been logged!</span>--}}
        @else
            <button id="loginButton" class="btn btn-success">Login <i class="fas fa-sign-in-alt"></i></button>
            <button id="registerButton" class="btn btn-info">Register <i class="fas fa-user-plus"></i></button>
        @endif
    </h1>
</div>




<!-- Modal login -->
<div class="modal fade" id="modalLogin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">User Login <i class="fa fa-user"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="loginForm" action="{{route('user.check')}}" method="post">
                @csrf
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" class="form-control" name="email"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" class="form-control" name="password" ></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success form-control">Login</button>
                <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
            </div>

                <div class="modal-footer">
                    <button  class="btn btn-primary form-control">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal register -->
<div class="modal fade" id="modalRegister" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">User Register <i class="fa fa-user"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="registerForm" action="{{route('user.register')}}" method="post">
                @csrf
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" class="form-control" name="name" placeholder="Enter Your Name..." value="{{old('name')}}"></td>
                            <span class="text-danger">@error('name'){{$message}}@enderror</span>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" class="form-control" name="email" placeholder="Enter Your Email..." value="{{old('email')}}"></td>
                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" class="form-control" name="password" placeholder="Enter Your Password" value="{{old('password')}}"></td>
                            <span class="text-danger">@error('password'){{$message}}@enderror</span>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="renamePassword" class="form-control" placeholder="Re-enter Your Password" value="{{old('renamePassword')}}"></td>
                            <span class="text-danger">@error('renamePassword'){{$message}}@enderror</span>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success form-control">Register</button>
                    <button type="button" class="btn btn-secondary form-control" data-dismiss="modal">Close</button>
                </div>


            </form>
        </div>
    </div>
</div>


<script>
    $('#loginButton').click(function () {
        $('#modalLogin').modal('show');
    });
    $('#showUserData').click(function () {
        $('#showUserData').text('Refresh');
        $(this).attr('id','refreshButton');

        $('#refreshButton').click(function () {
            window.location.reload();
        });
    });


    $('#registerButton').click(function () {
        $('#modalRegister').modal('show');
    });

    $('#registerForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('user.register')}}",
            method: 'post',
            data: $('#registerForm').serialize(),
            success: function (data) {
                console.log(data);
                $('#modalRegister').modal('hide');
                $('#modalLogin').modal('show');
            },
            error: function (response) {
                console.log(response.responseJSON);
                console.log(response.responseText);
            }
        });
    });


    {{--$('#loginForm').on('submit', function (e) {--}}
    {{--    e.preventDefault();--}}
    {{--    $.ajax({--}}
    {{--        url: "{{route('user.check')}}",--}}
    {{--        method: 'post',--}}
    {{--        data: $('#loginForm').serialize(),--}}
    {{--        success: function (data) {--}}
    {{--            console.log('ok');--}}
    {{--        },--}}
    {{--        error: function (response) {--}}
    {{--            console.log(response);--}}
    {{--        }--}}
    {{--    });--}}
    {{--})--}}
</script>
</body>
</html>
