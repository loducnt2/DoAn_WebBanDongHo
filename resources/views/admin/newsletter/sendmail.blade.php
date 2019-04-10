@extends('admin.layouts.index')

@section('title') Gửi tin tức @endsection

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
                <div class="panel-heading"> Gửi tin tức đến người đăng ký
                    <p>
                        <a href="{{ url('admin/newsletter/list') }}">Danh sách người đăng ký</a>
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

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/newsletter/send-mail') }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Nội dung tin</label>
                                    <textarea class="form-control ckeditor" id="demo"  rows="3" name="contents_mail"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <input type="hidden" name="name_con" value="">
                                <input type="hidden" name="email_con" value="">

                                <button type="submit" class="btn btn-primary">Gửi</button>
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