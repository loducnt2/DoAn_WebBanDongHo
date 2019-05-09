<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doanh thu</title>
    <!-- Core CSS - Include with every page -->
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
   </head>
   <style type="text/css">
       body {
            margin: 0px;
            font-family: DejaVu Sans;
        }
   </style>
<body>
    <div id="wrapper">
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
                                            <!-- $order->links() -->
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

    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/plugins/morris/morris.js"></script>
    <script src="assets/scripts/dashboard-demo.js"></script>
</body>

</html>