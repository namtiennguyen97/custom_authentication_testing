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
<div style="background-color: #8aafd7;height: 60px;background-image: url({{asset('eren.jpg')}})">
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
<form>
    <div class="container">
        <div class="row">
            <div>
                <input type="text" class="form-control" placeholder="Searching...">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Search <i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>

</form>
{{--showdata--}}
<table class="table table-dark">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody id="showData">
    @foreach(\App\Models\User::all() as $users)
        <tr>
            <td>{{$users->name}}</td>
            <td>{{$users->email}}</td>
            @if($users->image == NULL)
                <td><img src="{{asset('001-fix.jpg')}}" width="50" style="width: 50px;height: 50px" class="img img-thumbnail"></td>
                @else
                <td><img src="{{asset('storage/'.$users->image)}}" width="50" style="width: 50px;height: 50px" class="img img-thumbnail"></td>
                @endif
            @if(\Illuminate\Support\Facades\Session::has('logged'))
            @if($users->id === $user->id)
                <td>You <i class="fa fa-star"></i></td>
                @endif
                @endif
        </tr>
        @endforeach
    </tbody>
</table>

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
                        <td><input type="text" class="form-control" name="email" id="emailLogin"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" class="form-control" name="password"  id="passwordLogin"></td>
                    </tr>

                </table>
                <span class="text-danger emailLogin"></span>
                <br>
                <span class="text-danger passwordLogin"></span>
                <br>
                <span class="text-danger loginFail" ></span>
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
                            <td><input type="text" class="form-control" name="name" id="nameRegister" placeholder="Enter Your Name..." ></td>
                        </tr>
                        <tr>
                            <td><span class="text-danger nameRegister"></span></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" class="form-control" name="email" id="emailRegister" placeholder="Enter Your Email..." ></td>
                        </tr>
                        <tr>
                            <td><span class="text-danger emailRegister"></span></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" class="form-control" name="password" id="passwordRegister" placeholder="Enter Your Password" ></td>
                        </tr>
                        <tr>
                            <td><span class="text-danger passwordRegister"></span></td>
                        </tr>
                        <tr>
                            <td>Re-enter Password:</td>
                            <td><input type="password" name="reEnterPassword" class="form-control" id="rePasswordRegister" placeholder="Re-enter Your Password"></td>
                        </tr>
                        <tr>
                           <td><span class="text-danger rePasswordRegister"></span></td>
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
                toastr.success('Register successfully! Return to Login!');
                $('#modalRegister').modal('hide');
                $('#modalLogin').modal('show');
            },
            error: function (response) {
                console.log(response.responseJSON.errors.name);
                if (response.responseJSON.errors.name){
                    $('#nameRegister').removeClass('is-valid');
                    $('#nameRegister').addClass('is-invalid');
                    $('.nameRegister').text(response.responseJSON.errors.name);
                }
                else {
                    $('#nameRegister').removeClass('is-invalid');
                    $('#nameRegister').addClass('is-valid');
                }
                //validate truong email
                if (response.responseJSON.errors.email){
                    $('#emailRegister').removeClass('is-valid');
                    $('#emailRegister').addClass('is-invalid');
                    $('.emailRegister').text(response.responseJSON.errors.email);
                }
                else {
                    $('#emailRegister').removeClass('is-invalid');
                    $('#emailRegister').addClass('is-valid');
                }
                //validate truong repassword
                if (response.responseJSON.errors.reEnterPassword){
                    $('#rePasswordRegister').removeClass('is-valid');
                    $('#rePasswordRegister').addClass('is-invalid');
                    $('.rePasswordRegister').text(response.responseJSON.errors.reEnterPassword);
                }
                else {
                    $('#rePasswordRegister').removeClass('is-invalid');
                    $('#rePasswordRegister').addClass('is-valid');
                }

                //validate truong password


                if (response.responseJSON.errors.password){
                    $('#passwordRegister').removeClass('is-valid');
                    $('#passwordRegister').addClass('is-invalid');
                    $('.passwordRegister').text(response.responseJSON.errors.password);
                }
                else {
                    $('#passwordRegister').removeClass('is-invalid');
                    $('#passwordRegister').addClass('is-valid');
                }


            }
        });
    });


    $('#loginForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('user.check')}}",
            method: 'post',
            dataType: 'JSON',
            data: $('#loginForm').serialize(),
            success: function (data) {
              console.log('LOGIN SUCCESSFULL');
              toastr.success('Login successfully!');
              window.location.reload();
            },
            error: function (response) {
                console.log(response.responseJSON.message);
                // $('.loginFail').text(response.responseJSON.message);
                toastr.error("Your username or password is invalid! Please check again...");
                //validate email
                if (response.responseJSON.errors.email){
                    $('#emailLogin').removeClass('is-valid');
                    $('#emailLogin').addClass('is-invalid');
                    $('.emailLogin').text(response.responseJSON.errors.email);
                }else{
                    $('#emailLogin').removeClass('is-invalid');
                    $('#emailLogin').addClass('is-valid');
                }
                //validate password login
                if (response.responseJSON.errors.password){
                    $('#passwordLogin').removeClass('is-valid');
                    $('#passwordLogin').addClass('is-invalid');
                    $('.passwordLogin').text(response.responseJSON.errors.password);
                }else{
                    $('#passwordLogin').removeClass('is-invalid');
                    $('#passwordLogin').addClass('is-valid');
                }
            }
        });
    })


</script>
</body>
</html>
