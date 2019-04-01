@extends('admin.layouts.index')

@section('title') Thêm mới thương hiệu @endsection

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
                    <p style="color: red;">Thêm mới thương hiệu</p>
                    <p>
                        <a href="{{ url('admin/trade/list') }}">Danh sách thương hiệu</a>
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
                            <form action="{{ url('admin/trade/create') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên thương hiệu (*)</label>
                                    <input class="form-control" name="name_trade" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="avt_trade" />
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="address_trade" placeholder="Địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <textarea class="form-control ckeditor" id="demo"  rows="3" name="description_trade"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Tên danh mục (*)</label>
                                    <select class="form-control" name="category">
                                        @foreach($cate as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_cate }}</option>
                                        @endforeach
                                    </select>
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