@extends('admin.layouts.index')

@section('title') Cập nhật thông tin hỗ trợ khách hàng @endsection

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
                    <p>
                        <a href="{{ url('admin/customercare/list') }}">Danh sách</a>
                    </p>
                </div>

                @if(session('notify'))
                    <div class="alert alert-success">
                        {{ session('notify') }}
                    </div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/customercare/edit/'. $customerCare->id ) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                
                                <div class="form-group">
                                    <label>Chính sách bảo hành</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="warranty_policy">{{ $customerCare->warranty_policy }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Chính sách đổi trả</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="return_policy">{{ $customerCare->return_policy }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Chính sách bảo mật thông tin</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="info_security_policy">{{ $customerCare->info_security_policy }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Chính sách với hàng từ nước ngoài</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="policy_foreigner">{{ $customerCare->policy_foreigner }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Chính sách vận chuyển</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="delivery_policy">{{ $customerCare->delivery_policy }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Hướng dẫn thanh toán</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="payment_guide">{{ $customerCare->payment_guide }}</textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label>Hướng dẫn mua hàng</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="shopping_guide">{{ $customerCare->shopping_guide }}</textarea>
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