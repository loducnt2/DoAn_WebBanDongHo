@extends('admin.layouts.index')

@section('title') Cập nhật thông tin thương hiệu @endsection

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
                <div class="panel-heading"> Cập nhật thương hiệu : 
                    <span style="font-weight: bold;">{{ $brand->name_brand }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/brand/list') }}">Danh sách thương hiệu</a>
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
                            <form action="{{ url('admin/brand/edit/'. $brand->id ) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên thương hiệu (*)</label>
                                    <input class="form-control" name="name_brand" value="{{ $brand->name_brand }}" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <img src="{{  url('upload/brand/'.$brand->avt_brand) }}" width="150px">
                                    <input type="file" class="form-control" name="avt_brand" />
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="address_brand" value="{{ $brand->address_brand }}" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <input class="form-control" name="description_brand" value="{{ $brand->description_brand }}" placeholder="Miêu tả">
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