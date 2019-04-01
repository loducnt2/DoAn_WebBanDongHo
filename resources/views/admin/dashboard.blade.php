@extends('admin.layouts.index')

@section('title') Cud Shop @endsection

@section('content')
<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Trang chủ</h1>
        </div>
        <!--End Page Header -->
    </div>

    <div class="row">
        @if(session('notifyAuthority'))
            <div class="alert alert-danger">
                {{ session('notifyAuthority') }}
            </div>
        @endif
    </div>

    @if(Auth::check())
        <div class="row">
            <!-- Welcome -->
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <i class="fa fa-folder-open"></i>&nbsp; Chào mừng <b>&nbsp; {{ Auth::user()->name  }} &nbsp;</b>
     đến với trang quản trị.
                </div>
            </div>
            <!--end  Welcome -->
        </div>
    @endif

    <div class="row">
        <!--quick info section -->
        <div class="col-lg-3">
            <div class="alert alert-danger text-center">
                <i class="fa fa-calendar fa-3x"></i><b>&nbsp; {{ number_format($orderCount) }} &nbsp;</b>Tổng số hóa đơn
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-warning text-center">
                <i class="fa  fa-pencil fa-3x"></i>&nbsp;<b>&nbsp; {{ number_format($proCount) }} &nbsp;</b>Sản phẩm
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-success text-center">
                <i class="fa  fa-beer fa-3x"></i><b>&nbsp; {{ number_format($userCount) }} &nbsp;</b>Tài khoản khách hàng
            </div>
        </div>
        <div class="col-lg-3">
            <div class="alert alert-info text-center">
                <i class="fa fa-rss fa-3x"></i><b>&nbsp; {{ number_format($empCount) }} &nbsp;</b> Nhân viên giao hàng

            </div>
        </div>
        <!--end quick info section -->
    </div>

    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-8"></div>
                            <div class="col-sm-4 search-admin">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <form action="{{ url('admin/adminpage') }}" method="GET">
                                        <label class="lable-search-admin">
                                            <input type="search" name="keyword" class="form-control input-sm" aria-controls="dataTables-example"
                                                   @if(Request::has('keyword'))
                                                   value="{{ Request::get('keyword') }}"
                                                   @endif
                                                   placeholder="Tìm kiếm..." />
                                            <input type="submit" value="Search" style="width: 80px" />
                                        </label>
                                    </form>
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
                                        colspan="1" aria-label="Browser: activate to sort column ascending">Địa chỉ giao hàng
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
                                            <a href="{{ url('admin/order/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc xóa chứ?')">Xóa</a>
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
        </div>

        <div class="col-lg-3">
            <div class="panel panel-primary text-center no-boder">
                <div class="alert alert-warning text-center yellow">
                    <i style="color: black;" class="fa fa-bar-chart-o fa-3x"></i>
                    <h3 style="color: black;">&nbsp; {{ number_format($brandCount) }} &nbsp;</h3> <p style="color: black;">Thương hiệu</p>
                </div>
            </div>
            <div class="panel panel-primary text-center no-boder">
                <div class="alert alert-warning text-center blue">
                    <i style="color: black;" class="fa fa-bar-chart-o fa-3x"></i>
                    <h3 style="color: black;">&nbsp; {{ number_format($newsletterCount) }} &nbsp;</h3> <p style="color: black;">Người đăng ký nhận tin</p>
                </div>
            </div>
            <div class="panel panel-primary text-center no-boder">
                <div class="alert alert-warning text-center green">
                    <i style="color: black;" class="fa fa-bar-chart-o fa-3x"></i>
                    <h3 style="color: black;">&nbsp; {{ number_format($postCount) }} &nbsp;</h3> <p style="color: black;">Bài viết</p>
                </div>
            </div>
            <div class="panel panel-primary text-center no-boder">
                <div class="alert alert-warning text-center red">
                    <i style="color: black;" class="fa fa-bar-chart-o fa-3x"></i>
                    <h3 style="color: black;">&nbsp; {{ number_format($contactCount) }} &nbsp;</h3> <p style="color: black;">Phản hồi - Liên hệ</p>
                </div>
            </div>
        </div>

    </div>

    <!-- <div class="row">
        <div class="col-lg-4">
            Notifications
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i>Notifications Panel
                </div>
    
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i>New Comment
                            <span class="pull-right text-muted small"><em>4 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i>3 New Followers
                            <span class="pull-right text-muted small"><em>12 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i>Message Sent
                            <span class="pull-right text-muted small"><em>27 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i>New Task
                            <span class="pull-right text-muted small"><em>43 minutes ago</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i>Server Rebooted
                            <span class="pull-right text-muted small"><em>11:32 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-bolt fa-fw"></i>Server Crashed!
                            <span class="pull-right text-muted small"><em>11:13 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-warning fa-fw"></i>Server Not Responding
                            <span class="pull-right text-muted small"><em>10:57 AM</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-shopping-cart fa-fw"></i>New Order Placed
                            <span class="pull-right text-muted small"><em>9:49 AM</em>
                            </span>
                        </a>
    
                    </div>
                    /.list-group
                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                </div>
    
            </div>
            End Notifications
        </div>
        <div class="col-lg-4">
            Donut Example
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>Donut Chart Example
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                    <a href="#" class="btn btn-default btn-block">View Details</a>
                </div>
    
            </div>
            End Donut Example
        </div>
        <div class="col-lg-4">
            Chat Panel Example
            <div class="chat-panel panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-comments fa-fw"></i>
                    Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh fa-fw"></i>Refresh
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check-circle fa-fw"></i>Available
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-times fa-fw"></i>Busy
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o fa-fw"></i>Away
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-sign-out fa-fw"></i>Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
    
                <div class="panel-body">
                    <ul class="chat">
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong>
                                    <small class="pull-right text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i>12 mins ago
                                    </small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="left clearfix">
                            <span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong>
                                    <small class="pull-right text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i>14 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix">
                            <span class="chat-img pull-right">
                                <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted">
                                        <i class="fa fa-clock-o fa-fw"></i>15 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
    
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send
                            </button>
                        </span>
                    </div>
                </div>
    
            </div>
            End Chat Panel Example
        </div>
    </div> -->
</div>
@endsection