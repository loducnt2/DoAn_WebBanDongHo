
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật tài khoản</title>
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
                        <h3 class="panel-title">Cập nhật tài khoản</h3>
                        <h2 style="font-weight: bold;">{{ $user_client->name }}</h2>
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

                        <form action="{{ url('client') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên tài khoản</label>
                                    <input class="form-control" name="name" value="{{ $user_client->name }}" placeholder="Tên tài khoản">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="{{ $user_client->email }}" name="email" disabled="">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="changePassword" name="changePassword">
                                    <label>Đổi mật khẩu</label>
                                    <input type="password" class="form-control passwordOpen" name="password" placeholder="Mật khẩu mới..." disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control passwordOpen" name="passwordAgain" placeholder="Nhập lại mật khẩu..." disabled="" />
                                </div>
                                <div class="form-group">
                                    <label>Họ</label>
                                    <input class="form-control" value="{{ $user_client->last_name }}" name="last_name" placeholder="Họ">
                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input class="form-control" value="{{ $user_client->first_name }}" name="first_name" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <img src="{{  url('upload/user/'.$user_client->avatar) }}" width="150px">
                                    <input type="file" class="form-control" name="avatar" />
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="number" class="form-control" value="{{ $user_client->phone }}" name="phone" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" value="{{ $user_client->address }}" name="address" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <label class="radio-inline">
                                        <input name="gender" value="0"
                                        @if($user_client->gender == 0)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Nam
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender" value="1" 
                                        @if($user_client->gender == 1)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Nữ
                                    </label> 
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-success">Làm mới</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('admin_asset/assets/plugins/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    
    <script type="text/javascript">
        /*1. Gán id hoặc class cho thẻ input checkbox và 2 thẻ input password*/

            $("#changePassword").change(function(){
                if($(this).is(":checked")){
                    $(".passwordOpen").removeAttr('disabled');
                }else{
                    $(".passwordOpen").attr('disabled', '');  // attr('disabled', '') : Thêm thuộc tính disable và cái '' là : giá trị của nó
                }
            });

    </script>
</body>

</html>
