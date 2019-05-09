@extends('admin.layouts.index')

@section('title') Danh sách hóa đơn @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách hóa đơn</h1>
            </div>
            <!-- end  page header -->
            @if(session('success'))
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <!-- <div class="panel-heading">
                        Danh sách hóa đơn
                    </div> -->
                    <div class="col-lg-12">
                        @if(session('notifyDelete'))
                            <div class="alert alert-success">
                                {{ session('notifyDelete') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-12">
                        @if(session('notifyDate'))
                            <div class="alert alert-danger">
                                {{ session('notifyDate') }}
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                        <form action="{{ url('admin/order/filter') }}" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <label class="lable-search-admin">
                                                <input type="date" name="date1" class="form-control input-sm" aria-controls="dataTables-example"/>
                                                <input type="date" name="date2" class="form-control input-sm" aria-controls="dataTables-example"/>
                                                <input type="submit" value="Lọc" style="width: 80px" />
                                            </label>
                                        </form>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-4 search-admin">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                        <form action="{{ url('admin/order/list') }}" method="GET">
                                            <label class="lable-search-admin">
                                                <input type="search" name="keyword" class="form-control input-sm" aria-controls="dataTables-example"
                                                       @if(Request::has('keyword'))
                                                       value="{{ Request::get('keyword') }}"
                                                       @endif
                                                       placeholder="Tìm kiếm..." />
                                                <input type="submit" value="Tìm kiếm" style="width: 80px" />
                                            </label>
                                        </form>
                                    </div>
                                </div> -->
                                <div class="col-sm-4 search-admin" style="display: flex;">
                                    <div id="dataTables-example_filter" class="dataTables_filter" style="margin-right: 10px;">
                                        <a href="{{ url('admin/order/order_finish') }}"><button style="width: 80px">Thành công</button></a>
                                    </div>
                                    <div id="dataTables-example_filter" class="dataTables_filter" style="margin-right: 10px;">
                                        <a href="{{ url('admin/order/order_processing') }}"><button style="width: 80px">Đang xử lý</button></a>
                                    </div>
                                    <div id="dataTables-example_filter" class="dataTables_filter" style="margin-right: 10px;">
                                        <a href="{{ url('admin/order/order_sending') }}"><button style="width: 80px">HĐ Đang giao</button></a>
                                    </div>
                                    <div id="dataTables-example_filter" class="dataTables_filter" style="margin-right: 10px;">
                                        <a href="{{ url('admin/order/order_cancel') }}"><button style="width: 80px">HĐ Đã hủy</button></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Rendering engine: activate to sort column ascending">
                                            ID
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Người đặt
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tổng giá
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Nhân viên giao hàng
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">SĐT người nhận
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Địa chỉ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Ghi chú
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tình trạng
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Ngày đặt
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <!-- <td>
                                                <?php 
                                                    $totalAmount = 0; 
                                                ?>
                                                    @foreach($item->orderdetail as $dItem)
                                                        <?php 
                                                            $Newdiscount = (100-$dItem->product->discount_pro)/100;
                                                            $totalAmount += ($dItem->quantity*$dItem->product->price_pro*$Newdiscount);
                                                         ?>
                                                    @endforeach
                                                    {{ number_format($totalAmount) }}
                                            </td> -->
                                            <td>{{ number_format($item->total) }}</td>

                                            <td>{{ $item->employee->name_emp }}</td>
                                            <td>{{ $item->delivery_phone }}</td>
                                            <td>{{ $item->delivery_address }}</td>
                                            <td>{{ $item->note_order }}</td>
                                            <td>
                                                @if($item->status_order == 0)
                                                    {{"Đã hoàn thành"}}  
                                                @endif
                                                @if($item->status_order == 1)
                                                    {{"Đang xử lý"}} 
                                                @endif
                                                @if($item->status_order == 2)
                                                    {{"Đang gửi"}} 
                                                @endif 
                                                @if($item->status_order == 3)
                                                    {{"Đã hủy"}}    
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{ url('admin/order/detail/'.$item->id) }}">Chi tiết</a>  |  
                                                <a href="{{ url('admin/order/edit/'.$item->id) }}">Sửa</a>   |  
                                                <a href="{{ url('admin/order/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc muốn xóa hóa đơn này chứ?')">Xóa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-sm-9"></div>
                                <div class="col-sm-3">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="dataTables-example_paginate">
                                        {{ $order->links() }}
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
@endsection