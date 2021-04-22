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
                    <li><a class="dropdown-item" href="{{route('index')}}"><span class="btn btn-primary">Return Main Page <i class="fa fa-home"></i></span></a></li>
                    <li><a class="dropdown-item" href="#"><form method="post" action="{{route('user.logout')}}">
                                @csrf
                                <button type="submit" class="btn btn-danger form-control">Logout  <i class="fa fa-sign-out-alt"></i></button>
                            </form></a></li>
                    {{--                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                </ul>
            </div>

        </div>
    @endif

    <h3 align="center">Welcome {{$user->name}} dashboard</h3>
</div>
<div class="container">
    <div class="row">
        <div class="col border border-primary">
            @if($user->image == NULL)
                <div class="col-8">
                    <img src="{{asset('001-fix.jpg')}}" width="50%"  alt="This image is default">
                </div>
            <div class="col-md-auto">
                <span class="text-danger">This image is default image</span>
            </div>

            @else
                <div class="col">
                    <img src="{{asset('/storage/'.$user->image)}}" width="50%">
                </div>
            @endif
            <form method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="col">
                    <label class="btn btn-warning btn-file">
                        Upload<input type="file" style="display: none;">
                    </label>
                    <label class="btn btn-success btn-file">Save</label>
                </div>
            </form>
            <br>

            <div class="col" style="background-color: #489645"><h5 align="center">Information</h5>
                <form method="post">
                    @csrf
                    <div class="col-md-12">
                        <span><a>Name</a></span>
                        <input class="form-control" value="{{$user->name}}">
                    </div>
                    <div class="col-md-12">
                        <span><a>Email</a></span>
                        <input class="form-control" value="{{$user->email}}">
                    </div>
                    <br>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-info">Save Change</button>
                    </div>
                </form>
            </div>
            <br>
            <div class="col" style="background-color: #489645"><h5 align="center">Change Password</h5>
                <form method="post">
                    @csrf
                    <div class="col-md-12">
                        <span><a>Old Password</a></span>
                        <input class="form-control" type="password" placeholder="Your old password...">
                    </div>
                    <div class="col-md-12">
                        <span><a>New Password</a></span>
                        <input class="form-control">
                    </div>
                    <div class="col-md-12">
                        <span><a>Re-enter new Password</a></span>
                        <input class="form-control">
                    </div>
                    <br>
                    <div class="col-sm">
                        <button type="submit" class="btn btn-info">Change password</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="col border border-primary" style="background-image: url({{asset('bbb.gif')}})">
            <h5></h5>
        </div>
    </div>
</div>


</body>
</html>
