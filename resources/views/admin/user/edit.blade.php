@extends('admin.layouts.index')

@section('title') Edit Type User @endsection

@section('content')
<div id="page-wrapper">
    <div class="row">
        <!-- page header -->
        <div class="col-lg-12">
            <h1 class="page-header"></h1>
        </div>
        <!--end page header -->
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Elements -->
            <div class="panel panel-default">
                <div class="panel-heading"> Cập nhật tài khoản : 
                    <span style="font-weight: bold;">{{ $user->name }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/user/list') }}">Danh sách loại tài khoản</a>
                    </p>
                </div>

                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('loi'))
                    <div class="alert alert-danger">
                        {{ session('loi') }}
                    </div>
                @endif

                @if(session('notify'))
                    <div class="alert alert-success">
                        {{ session('notify') }}
                    </div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/user/edit/'.$user->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên tài khoản</label>
                                    <input class="form-control" name="name" value="{{ $user->name }}" placeholder="Tên tài khoản" disabled="">
                                </div>
                                @if(Auth::user()->idTypeUser == 1)
                                    <div class="form-group">
                                        <label>Loại tài khoản</label>
                                        <select class="form-control" name="typeuser">
                                            @foreach($type as $item)
                                                <option 
                                                    @if($user->idTypeUser == $item->id)
                                                        {{"selected"}}
                                                    @endif 
                                                    value="{{ $item->id }}">{{ $item->name_type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
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
                                    <input class="form-control" value="{{ $user->last_name }}" name="last_name" placeholder="Họ">
                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input class="form-control" value="{{ $user->first_name }}" name="first_name" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <img src="{{  url('upload/user/'.$user->avatar) }}" width="150px">
                                    <input type="file" class="form-control" name="avatar" />
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="number" class="form-control" value="{{ $user->phone }}" name="phone" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" value="{{ $user->address }}" name="address" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <label class="radio-inline">
                                        <input name="gender" value="0"
                                        @if($user->gender == 0)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Nam
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender" value="1" 
                                        @if($user->gender == 1)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Nữ
                                    </label> 
                                </div>

                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-success">Làm mới</button>
                            </form>
                        </div>
                        <div class="col-lg-6"></div>
                    </div>
                </div>
            </div>
             <!-- End Form Elements -->
        </div>
    </div>
</div>
@endsection

@section('script')
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
@endsection