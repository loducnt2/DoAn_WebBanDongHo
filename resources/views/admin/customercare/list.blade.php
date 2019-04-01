@extends('admin.layouts.index')

@section('title') Thông tin phần hỗ trợ khách hàng @endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <!--  page header -->
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin phần hỗ trợ khách hàng</h1>
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
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Chính sách đổi trả
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Chính sách hàng nhập khẩu
                                        </th>
                                        
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1"
                                            colspan="1" aria-label="Browser: activate to sort column ascending">Tùy chọn
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customerCare as $item)
                                        <tr class="even gradeC">
                                            <td>{{ $item->id }}</td>
                                            <td>{!! $item->return_policy !!}</td>
                                            <td>{!! $item->policy_foreigner !!}</td>

                                            <td>
                                                <a href="{{ url('admin/customercare/edit/'.$item->id) }}">Sửa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>

                            
                            </div>
                        </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
@endsection