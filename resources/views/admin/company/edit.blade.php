@extends('admin.layouts.index')

@section('title') Cập nhật thông tin công ty @endsection

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
                <div class="panel-heading"> Cập nhật thông tin: 
                    <span style="font-weight: bold;">{{ $company->name_company }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/company/list') }}">Danh sách</a>
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
                            <form action="{{ url('admin/company/edit/'. $company->id ) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên công tu</label>
                                    <input class="form-control" name="name_company" placeholder="Tên công ty" value="{{ $company->name_company }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email_company" placeholder="Địa chỉ email" value="{{ $company->email_company }}">
                                </div>
                                <div class="form-group">
                                    <label>SĐT</label>
                                    <input class="form-control" name="phone_company" placeholder="Số điện thoại" value="{{ $company->phone_company }}">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="address_company" placeholder="Địa chỉ công ty..." value="{{ $company->address_company }}">
                                </div>
                                <div class="form-group">
                                    <label>Ảnh</label>
                                    <img src="{{ url('upload/company/'.$company->avatar_company) }}" width="150px">
                                    <input type="file" class="form-control" name="avatar_company" />
                                </div>
                                <div class="form-group">
                                    <label>Link Facebook</label>
                                    <input class="form-control" name="link_fb" placeholder="Địa chỉ facebook" value="{{ $company->link_fb }}">
                                </div>
                                <div class="form-group">
                                    <label>Link Twiter</label>
                                    <input class="form-control" name="link_twiter" placeholder="Địa chỉ twiter" value="{{ $company->link_twiter }}">
                                </div>
                                <div class="form-group">
                                    <label>Link Youtube</label>
                                    <input class="form-control" name="link_youtube" placeholder="Địa chỉ youtube" value="{{ $company->link_youtube }}">
                                </div>
                                <div class="form-group">
                                    <label>Link G+</label>
                                    <input class="form-control" name="link_g" placeholder="Địa chỉ G+" value="{{ $company->link_g }}">
                                </div>
                                <div class="form-group">
                                    <label>Link Vimeo</label>
                                    <input class="form-control" name="link_vimeo" placeholder="Địa chỉ link vimeo..." value="{{ $company->link_vimeo }}">
                                </div>
                                <div class="form-group">
                                    <label>Giới thiệu công ty</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="introduce">{{ $company->introduce }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Giải quyết khiếu nại</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="resolve_complaints">{{ $company->resolve_complaints }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Điều khoản sử dụng</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="rules">{{ $company->rules }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
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