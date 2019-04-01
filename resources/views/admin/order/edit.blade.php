@extends('admin.layouts.index')

@section('title') Cập nhật thông tin hóa đơn @endsection

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
                <div class="panel-heading"> Cập nhật hóa đơn : 
                    <span style="font-weight: bold;">{{ $order->id }}</span>
                    <br><br>
                    <p>
                        <a href="{{ url('admin/order/list') }}">Danh sách hóa đơn</a>
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

                @if(session('notify'))
                    <div class="alert alert-success">
                        {{ session('notify') }}
                    </div>
                @endif

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <form action="{{ url('admin/order/edit/'. $order->id ) }}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="form-group">
                                    <label>Tên khách hàng</label>
                                    <input class="form-control" name="user" placeholder="Tên khách hàng" value="{{ $order->user->name }}" disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Tên nhân viên giao hàng (*)</label>
                                    <select class="form-control" name="employee">
                                        @foreach($emp as $item)
                                            <option 
                                            @if($order->idEmployee == $item->id)
                                                {{"selected"}}
                                            @endif
                                                value="{{ $item->id }}">{{ $item->name_emp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>SĐT</label>
                                    <input class="form-control" name="delivery_phone" placeholder="Số điện thoại" value="{{ $order->delivery_phone }}" disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input class="form-control" name="delivery_address" placeholder="Địa chỉ" value="{{ $order->delivery_address }}" disabled="">
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input class="form-control" name="note_order" placeholder="Ghi chứ" value="{{ $order->note_order }}">
                                </div>
                                <div class="form-group">
                                    <label>Tình trạng</label>
                                    <label class="radio-inline">
                                        <input name="status_order" value="0"
                                        @if($order->status_order == 0)
                                            {{ "checked" }}
                                        @endif
                                        type="radio">Đã hoàn thành
                                    </label>
                                    <label class="radio-inline">
                                        <input name="status_order" value="1" 
                                        @if($order->status_order == 1)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Đang xử lý
                                    </label> 
                                    <label class="radio-inline">
                                        <input name="status_order" value="2" 
                                        @if($order->status_order == 2)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Đang gửi
                                    </label> 
                                    <label class="radio-inline">
                                        <input name="status_order" value="3" 
                                        @if($order->status_order == 3)
                                            {{ "checked" }}
                                        @endif
                                          type="radio">Đã hủy
                                    </label> 
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