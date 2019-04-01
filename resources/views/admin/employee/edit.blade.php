@extends('admin.layouts.index')

@section('title') Cập nhật thông tin nhân viên @endsection

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
                <div class="panel-heading"> Cập nhật tài khoản nhân viên : 
                    <span style="font-weight: bold;">{{ $emp->name }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/employee/list') }}">Danh sách nhân viên</a>
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
                            <form action="{{ url('admin/employee/edit/'.$emp->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên tài khoản (*)</label>
                                    <input class="form-control" name="name_emp" value="{{ $emp->name_emp }}" placeholder="Tên tài khoản">
                                </div>
                                <div class="form-group">
                                    <label>Họ</label>
                                    <input class="form-control" value="{{ $emp->last_name_emp }}" name="last_name_emp" placeholder="Họ">
                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input class="form-control" value="{{ $emp->first_name_emp }}" name="first_name_emp" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <img src="{{  url('upload/employee/'.$emp->avatar_emp) }}" width="150px">
                                    <input type="file" class="form-control" name="avatar_emp" />
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại (*)</label>
                                    <input type="number" class="form-control" value="{{ $emp->phone_emp }}" name="phone_emp" placeholder="Số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ (*)</label>
                                    <input class="form-control" value="{{ $emp->address_emp }}" name="address_emp" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <label class="radio-inline">
                                        <input name="gender_emp" value="0"
                                        @if($emp->gender == 0)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Nam
                                    </label>
                                    <label class="radio-inline">
                                        <input name="gender_emp" value="1" 
                                        @if($emp->gender == 1)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Nữ
                                    </label> 
                                </div>

                                <button type="submit" class="btn btn-primary">Lưu lại</button>
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