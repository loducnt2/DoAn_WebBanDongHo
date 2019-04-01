<?php 
session_start();
use Illuminate\Support\Facades\Auth;

    if (Auth::check()) {
        header('Location: adminpage');
        exit();
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập trang quản trị</title>
    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('admin_asset/assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/plugins/pace/pace-theme-big-counter.css') }}" rel="stylesheet" />
   <link href="{{ asset('admin_asset/assets/css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('admin_asset/assets/css/main-style.css') }}" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <a class="navbar-brand" href="{{ url('admin/adminpage') }}">
                <img src="{{ url('images/cud-shop.png') }}" style="width: 190px;height: 35px;"> 
            </a>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Đăng nhập trang quản trị</h3>
                    </div>
                    <div class="panel-body">

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('notify'))
                        <div class="alert alert-danger">
                            {{ session('notify') }}
                        </div>
                    @endif

                    @if(session('notifyLogin'))
                        <div class="alert alert-danger">
                            {{ session('notifyLogin') }}
                        </div>
                    @endif

                        <form action="{{ url('admin/login') }}" method="POST">
                            <fieldset>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail..." name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật khẩu..." name="password" type="password" value="">
                                </div>
                                <!-- <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Đăng nhập</a> -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng nhập</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('admin_asset/assets/plugins/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/metisMenu/jquery.metisMenu.js') }}"></script>

</body>

</html>
