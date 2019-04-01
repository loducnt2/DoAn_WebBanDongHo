
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu</title>
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
              <a class="navbar-brand" href="{{ url('home') }}">
                <img src="{{ url('images/cud-shop.png') }}" style="width: 190px;height: 35px;"> 
            </a>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Thay đổi mật khẩu</h3>
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
                        <div class="alert alert-success">
                            {{ session('notify') }}
                        </div>
                    @endif

                    @if(session('notifyLogin'))
                        <div class="alert alert-danger">
                            {{ session('notifyLogin') }}
                        </div>
                    @endif
                        <form action="{{ url('reset-password/verify/'.$token_code) }}" method="POST">
                            <fieldset>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Mật khẩu (*)</label>
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu (*)</label>
                                    <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu..." />
                                </div>

                                <button type="submit" class="btn btn-lg btn-success btn-block">Thay đổi</button>
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
