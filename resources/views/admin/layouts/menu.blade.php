
<nav class="navbar-default navbar-static-side" role="navigation">
    <!-- sidebar-collapse -->
    <div class="sidebar-collapse">
        <!-- side-menu -->
        <ul class="nav" id="side-menu">
            <li>
                <!-- user image section-->
                @if(Auth::check())
                <div class="user-section">
                    <div class="user-section-inner">
                        <img src="{{ url('upload/user/'.Auth::user()->avatar) }}" alt="">
                    </div>
                    <div class="user-info">
                        <div><strong>{{ Auth::user()->name  }}</strong></div>
                        <div class="user-text-online">
                            <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp; Online
                        </div>
                    </div>
                </div>
                @endif
                <!--end user image section-->
            </li>
            <!-- <li class="sidebar-search">
                search section
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                end search section
            </li> -->
            <li class="selected">
                <a href="{{ url('admin/adminpage') }}"><i class="fa fa-dashboard fa-fw"></i>Trang chủ</a>
            </li>
            <li>
                <a href="{{ url('admin/order/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Hóa đơn</a>
            </li>
            <li>
                <a href="{{ url('admin/orderdetail/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Chi tiết hóa đơn</a>
                <!-- <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/orderdetail/list') }}">Danh sách</a>
                    </li>
                </ul> -->
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Danh mục<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/category/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/category/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Thương hiệu<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/trade/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/trade/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/product/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/product/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Bộ sưu tập ảnh<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/image/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/image/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Thể loại tài khoản<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/typeuser/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/typeuser/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Tài khoản<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/user/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/user/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Nhân viên giao hàng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/employee/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/employee/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <!-- <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Bình luận<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/comment/list') }}">Danh sách</a>
                    </li>
                </ul>
                second-level-items
            </li> -->
            <li>
                <a href="{{ url('admin/contact/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Liên hệ</a>
            </li>
            <li>
                <a href="{{ url('admin/newsletter/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Đăng ký nhận mail</a>
            </li>
            <li>
                <a href="{{ url('admin/company/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Công ty</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Bài viết<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ url('admin/post/list') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/post/create') }}">Thêm mới</a>
                    </li>
                </ul>
                <!-- second-level-items -->
            </li>
            <li>
                <a href="{{ url('admin/customercare/list') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Hỗ trợ khách hàng</a>
            </li>
             
        </ul>
        <!-- end side-menu -->
    </div>
    <!-- end sidebar-collapse -->
</nav>