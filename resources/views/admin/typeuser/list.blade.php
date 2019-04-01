@extends('admin.layouts.index')

@section('title') Danh sách loại tài khoản @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Tables</h1>
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
                        Danh sách loại tài khoản
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
                            <div class="row">
                                <div class="col-sm-8">
                                    <a href="{{ url('admin/typeuser/create') }}">Thêm mới thể loại tài khoản</a>
                                </div>
                                <div class="col-sm-4 search-admin">
                                    <div id="dataTables-example_filter" class="dataTables_filter">
                                        <form action="{{ url('admin/typeuser/list') }}" method="GET">
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
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tên thể loại
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($type as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name_type }}</td>
                                            <td>
                                                <a href="{{ url('admin/typeuser/edit/'.$item->id) }}">Sửa</a>   |  
                                                <a href="{{ url('admin/typeuser/delete/'.$item->id) }}" onclick="return confirm('Bạn chắc xóa chứ? Bao gồm các tài khoản liên quan')">Xóa</a>
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
                                        {{ $type->links() }}
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