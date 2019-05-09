@extends('admin.layouts.index')

@section('title') Thêm mới sản phẩm @endsection

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
                    <p style="color: red;">Thêm mới sản phẩm</p>
                    <p>
                        <a href="{{ url('admin/product/list') }}">Danh sách sản phẩm</a>
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
                            <form action="{{ url('admin/product/create') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên sản phẩm (*)</label>
                                    <input class="form-control" name="name_pro" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Danh mục (*)</label>
                                    <select class="form-control" name="category" id="category">
                                        @foreach($cate as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_cate }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thương hiệu (*)</label>
                                    <select class="form-control" name="trade" id="trade">
                                        @foreach($trade as $item)
                                            <option value="{{ $item->id }}">{{ $item->name_trade }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <input type="file" class="form-control" name="thumbnail_pro" />
                                </div>
                                <div class="form-group">
                                    <label>Giá (*)</label>
                                    <input type="number" class="form-control" name="price_pro" placeholder="Giá">
                                </div>
                                <div class="form-group">
                                    <label>Giảm giá (*)</label>
                                    <input type="number" class="form-control" name="discount_pro" placeholder="Giảm giá">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng (*)</label>
                                    <input type="number" class="form-control" name="quantity_pro" placeholder="Số lượng">
                                </div>
                                <div class="form-group">
                                    <label>Tình trạng (*)</label>
                                    <label class="radio-inline">
                                        <input name="status_pro" value="1" checked="true" type="radio">Còn hàng
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status_pro" value="0" type="radio">Hết hàng
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Nổi bật</label>
                                    <label class="radio-inline">
                                        <input name="outstanding" value="0" checked="true" type="radio">Không
                                    </label>
                                    <label class="radio-inline">
                                        <input name="outstanding" value="1" type="radio">Có
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="description_pro"></textarea>
                                    <script type="text/javascript">
                                        CKEDITOR.replace("demo");
                                    </script>
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
    <script>

            /*alert('Đã chạy được nhé ');*/
            /*
            1. Gán ID cho trường theloai va loaitin
            */
            var idCategory = $("#category").val();
            $.get("trade/"+idCategory, function(data){
                $("#trade").html(data);
            });

            /*2. Bắt sự kiện cái thằng Theloai thay đổi*/
            $("#category").change(function(){
                var idCategory = $(this).val();
                /*$(this).val() : Lấy chính giá tị của nó nó chính = $(#theloai)*/
                /*alert(idCategory);*/

            /*3. Tạo 1 trang ajax và truyền theo phương thức get() và gọi cái trang đó lên*/
                $.get("trade/"+idCategory, function(data){
                    /*Khi lấy được dữ liệu (từ idTheLoai) về nó sẽ trả vào trong data
                    Sau đó ta gán cái #loaitin  =  dữ liệu data vừa lấy được đấy*/

                    /*alert('đasad');*/
                    $("#trade").html(data);

                    /*Tạo cái route - admin/ajax/loaitin/id bên trang route và viết 
                    code hàm lấy dữ liệu từ cái id của idTheLoai (Là những cái loaitin có idTheLoai = idTheLoai đang xét*/

                });
            });

    </script>
@endsection