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
                <div class="panel-heading"> Cập nhật loại tài khoản : 
                    <span style="font-weight: bold;">{{ $type->name_cate }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/typeuser/list') }}">Danh sách loại tài khoản</a>
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

                @if(session('notify'))
                    <div class="alert alert-success">
                        {{ session('notify') }}
                    </div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/typeuser/edit/'. $type->id ) }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên loại tài khoản</label>
                                    <input class="form-control" name="name_type" placeholder="Loại tài khoản" value="{{ $type->name_type }}">
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