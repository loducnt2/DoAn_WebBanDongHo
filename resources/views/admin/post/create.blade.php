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
                    <p style="color: red;">Thêm mới bài viết</p>
                    <p>
                        <a href="{{ url('admin/post/list') }}">Danh sách bài viết</a>
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
                            <form action="{{ url('admin/post/create') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tiêu đề (*)</label>
                                    <input class="form-control" name="title" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <input type="file" class="form-control" name="thumbnail" />
                                </div>
                                <!-- <div class="form-group">
                                    <label>Tóm tắt</label>
                                    <textarea class="form-control" rows="3" name="summary"></textarea>
                                </div> -->
                                <div class="form-group">
                                    <label>Nội dung (*)</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="contents"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
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