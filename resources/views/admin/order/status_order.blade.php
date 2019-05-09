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
            @if(Session::has('success'))
                <div class="col-lg-12">
                    <h1 class="page-header" style="background-color: #09a80f; color: white">
                        {{ Session::get('success') }}
                    </h1>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>
                            <a href="{{ url('admin/order/list') }}">Danh sách hóa đơn</a>
                        </p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-4 search-admin">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                         @foreach($order as $item)
                                            @if($item->status_order == 0)
                                                <a href="{{ url('hoa_don_da_hoan_thanh') }}"><button style="width: 80px">In</button></a>
                                                @break;
                                            @endif
                                            @if($item->status_order == 1)
                                                <a href="{{ url('hoa_don_dang_duoc_xu_ly') }}"><button style="width: 80px">In</button></a>
                                            @endif
                                            @if($item->status_order == 2)
                                                 <a href="{{ url('hoa_don_dang_duoc_gui') }}"><button style="width: 80px">In</button></a>
                                                @break;
                                            @endif 
                                            @if($item->status_order == 3)
                                               <a href="{{ url('hoa_don_bi_huy') }}"><button style="width: 80px">In</button></a>
                                               @break;
                                            @endif
                                        @endforeach
                                       
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
                                <?php 
                                    $total = 0; 
                                ?>
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

                                            <?php 
                                                $total = $total+$item->total;
                                            ?>
                                                
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
                                                <a href="{{ url('admin/order/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc xóa chứ?')">Xóa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td>Tổng: </td>
                                            <td>{{ number_format($total) }}</td>
                                        </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-sm-9"></div>
                                <div class="col-sm-3">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="dataTables-example_paginate">
                                        
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