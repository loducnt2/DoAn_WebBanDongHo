@extends('admin.layouts.index')

@section('title') Danh sách tài khoản @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách tài khoản</h1>
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
                    <div class="panel-heading"></div>
                    <div class="col-lg-12">
                        @if(session('notifyDelete'))
                            <div class="alert alert-success">
                                {{ session('notifyDelete') }}
                            </div>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-8">
                                    <a href="{{ url('admin/user/create') }}">Thêm mới tài khoản</a>
                                </div>
                                <div class="col-sm-4 search-admin">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                        <form action="{{ url('admin/user/list') }}" method="GET">
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
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Ảnh
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tên tài khoản
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Loại tài khoản
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Họ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tên
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">SĐT
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Địa chỉ
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Giới tính
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>
                                                <img src='{{ url("upload/user/$item->avatar") }}' width="100px" height="100px" width="50px" height="50px"> 
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->typeuser->name_type }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->last_name }}</td>
                                            <td>{{ $item->first_name }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                @if($item->gender == 0)
                                                    {{"Nam"}}    
                                                @else
                                                    {{"Nữ"}}    
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('admin/user/edit/'.$item->id) }}">Sửa</a>   |  
                                                <a href="{{ url('admin/user/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc xóa chứ?')">Xóa</a>
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
                                        {{ $user->links() }}
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