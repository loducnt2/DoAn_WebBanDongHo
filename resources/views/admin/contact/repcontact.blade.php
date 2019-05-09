@extends('admin.layouts.index')

@section('title') Trả lời liên hệ @endsection

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
                <div class="panel-heading"> Trả lời liên hệ
                    <span style="font-weight: bold;">{{ $con->email_con }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/contact/list') }}">Danh sách liên hệ</a>
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
                            <form action="{{ url('admin/contact/repcontact/'. $con->id ) }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Nội dung trả lời</label>
                                    <textarea name="rep_con" class="form-control" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="name_con" value="{{ $con->name_con }}">
                                <input type="hidden" name="email_con" value="{{ $con->email_con }}">

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