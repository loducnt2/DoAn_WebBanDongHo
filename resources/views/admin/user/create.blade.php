@extends('admin.layouts.index')

@section('title') Thêm mới tài khoản @endsection

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
                <div class="panel-heading">
                    <p style="color: red;">Thêm mới tài khoản</p>
                    <p>
                        <a href="{{ url('admin/user/list') }}">Danh sách tài khoản</a>
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
                            <form action="{{ url('admin/user/create') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên tài khoản (*)</label>
                                    <input class="form-control" name="name" placeholder="Tên tài khoản">
                                </div>
                                <div class="form-group">
                                    <label>Loại tài khoản (*)</label>
                                    <select class="form-control" name="typeuser">
                                        @foreach($type as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email (*)</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu (*)</label>
                                    <input type="password" class="form-control" name="password" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu (*)</label>
                                    <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu..." />
                                </div>
                                <div class="form-group">
                                    <label>Họ</label>
                                    <input class="form-control" name="last_name" placeholder="Họ">
                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input class="form-control" name="first_name" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="avatar" />
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại (*)</label>
                                    <input type="number" class="form-control" name="phone" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ (*)</label>
                                    <input class="form-control" name="address" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <label class="radio-inline">
                                        <input name="gender" value="0" checked="true" type="radio">Nam
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender" value="1" type="radio">Nữ
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary">Thêm mới</button>
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