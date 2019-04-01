@extends('admin.layouts.index')

@section('title') Thông tin công ty @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin công ty</h1>
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
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tên
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Ảnh
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">SĐT
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Địa chỉ
                                        </th>
                                        
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($company as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name_company }}</td>
                                            <td>
                                                <img src='{{ url("upload/company/$item->avatar_company") }}' width="100px" height="100px" width="50px" height="50px"> 
                                            </td>
                                            <td>{{ $item->email_company }}</td>
                                            <td>{{ $item->phone_company }}</td>
                                            <td>{{ $item->address_company }}</td>
                                            
                                            <td>
                                                <a href="{{ url('admin/company/edit/'.$item->id) }}">Sửa</a>
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
                                        {{ $company->links() }}
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