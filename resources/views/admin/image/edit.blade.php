@extends('admin.layouts.index')

@section('title') Cập nhật ảnh sản phẩm @endsection

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
                <div class="panel-heading"> Cập nhật ảnh sản phẩm : 
                    <br><br>
                    <p>
                        <a href="{{ url('admin/image/list') }}">Danh sách bộ sưu tập ảnh</a>
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
                            <form action="{{ url('admin/image/edit/'. $image->id ) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Ảnh (*)</label>
                                    <img src="{{  url('upload/image/'.$image->img) }}" width="150px">
                                    <input type="file" class="form-control" name="img" />
                                </div>

                                <div class="form-group">
                                    <label>Tên sản phẩm (*)</label>
                                    <select class="form-control" name="product">
                                        @foreach($product as $item)
                                            <option 
                                                @if($image->idProduct == $item->id)
                                                    {{"selected"}}
                                                @endif 
                                                value="{{ $item->id }}">{{ $item->name_pro }}</option>
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