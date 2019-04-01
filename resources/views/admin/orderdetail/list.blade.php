@extends('admin.layouts.index')

@section('title') Danh sách chi tiết hóa đơn @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết hóa đơn</h1>
            </div>
            <!-- end  page header -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ url('admin/order/list') }}">Danh sách hóa đơn</a>
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
                                            colspan="1" aria-label="Browser: activate to sort column ascending">ID Hóa đơn
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Sản phẩm
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Số lượng
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Đơn giá
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Khuyến mại
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Thành tiền
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Ngày đặt
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detail as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->idOrder }}</td>
                                            <td>{{ $item->product->name_pro }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>
                                                <?php 
                                                    $totalAmount = 0; 
                                                ?>
                                                    <?php 
                                                        $Newdiscount = (100-$item->product->discount_pro)/100;
                                                        $totalAmount += ($item->quantity*$item->product->price_pro*$Newdiscount);
                                                     ?>
                                                    {{ number_format($totalAmount) }}
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-sm-9"></div>
                                <div class="col-sm-3">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="dataTables-example_paginate">
                                         {{ $detail->links() }}
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