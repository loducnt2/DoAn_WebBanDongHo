@extends('admin.layouts.index')

@section('title') Cập nhật sản phẩm @endsection

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
                <div class="panel-heading"> Cập nhật sản phẩm : 
                    <span style="font-weight: bold;">{{ $product->name_pro }}</span>
                    <br><br>
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
                    <div class="row" style="margin-bottom: 40px;">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/product/edit/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Tên sản phẩm (*)</label>
                                    <input class="form-control" name="name_pro" value="{{ $product->name_pro }}" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Danh mục (*)</label>
                                    <select class="form-control" name="category" id="category">
                                        @foreach($cate as $item)
                                            <option 
                                            @if($product->trade->category->id == $item->id)
                                                {{ "selected" }}
                                            @endif
                                            value="{{ $item->id }}">{{ $item->name_cate }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thương hiệu (*)</label>
                                    <select class="form-control" name="trade" id="trade">
                                        @foreach($trade as $item)
                                            <option 
                                            @if($product->trade->id == $item->id)
                                                {{ "selected" }}
                                            @endif
                                            value="{{ $item->id }}">{{ $item->name_trade }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <img src="{{  url('upload/product/'.$product->thumbnail_pro) }}" width="150px">
                                    <input type="file" class="form-control" name="thumbnail_pro" />
                                </div>
                                <div class="form-group">
                                    <label>Giá (*)</label>
                                    <input type="number" class="form-control" name="price_pro" value="{{ $product->price_pro }}" placeholder="Giá">
                                </div>
                                <div class="form-group">
                                    <label>Giảm giá (*)</label>
                                    <input type="number" class="form-control" name="discount_pro" value="{{ $product->discount_pro }}" placeholder="Giảm giá">
                                </div>
                                <div class="form-group">
                                    <label>Số lượng (*)</label>
                                    <input type="number" class="form-control" name="quantity_pro" value="{{ $product->quantity_pro }}" placeholder="Số lượng">
                                </div>

                                <div class="form-group">
                                    <label>Tình trạng (*)</label>
                                    <label class="radio-inline">
                                        <input name="status_pro" value="1"
                                        @if($product->status_pro == 1)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Còn hàng
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status_pro" value="2" 
                                        @if($product->status_pro == 0)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Hết hàng
                                    </label> 
                                </div>
                                <div class="form-group">
                                    <label>Nổi bật</label>
                                    <label class="radio-inline">
                                        <input name="outstanding" value="0"
                                        @if($product->outstanding == 0)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Không
                                    </label>
                                    <label class="radio-inline">
                                        <input name="outstanding" value="1" 
                                        @if($product->outstanding == 1)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Có
                                    </label> 
                                </div>
                                <div class="form-group">
                                    <label>Miêu tả</label>
                                    <textarea class="form-control ckeditor" id="demo" rows="3" name="description_pro">{{ $product->description_pro }}</textarea>
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
                    

                   <!--  Phần bình luận  -->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3>Danh sách các bình luận cho sản phẩm</h3>
                                </div>
                                <div class="col-lg-12">
                                    @if(session('notifyDelete'))
                                        <div class="alert alert-success">
                                            {{ session('notifyDelete') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column ascending">
                                                        ID
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">ID Sản phẩm
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">ID người dùng
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">Nội dung bình luận
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">Thời gian bình luận
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">Nội dung trả lời
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">Thời gian trả lời
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                                        colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($product->cmt as $item)
                                                    <tr class="even gradeC">
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->idProduct }}</td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td>{{ $item->content_cmt }}</td>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->content_rep }}</td>
                                                        <td>{{ $item->updated_at }}</td>
                                                        <td> 
                                                            <a href="/webdongho/public/admin/comment/delete/{{$item->id}}/{{$product->id}}" onclick="return confirm('Bạn chắc xóa chứ?')">Xóa</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>

                                        <div class="row">
                                            <div class="col-sm-6">

                                            </div>
                                            <div class="col-sm-6">
                                                <div class="dataTables_paginate paging_simple_numbers"
                                                     id="dataTables-example_paginate">
                                                    <!--  $group->links()  -->
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
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

        $("#category").change(function(){
            var idCategory = $(this).val();
            $.get("trade/"+idCategory, function(data){
                $("#trade").html(data);
            });
        });

</script>
@endsection
