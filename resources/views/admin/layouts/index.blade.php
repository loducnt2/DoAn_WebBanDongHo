<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <!-- Core CSS - Include with every page -->
    <link href="{{ asset('admin_asset/assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/plugins/pace/pace-theme-big-counter.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/css/admin.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_asset/assets/css/main-style.css') }}" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="{{ asset('admin_asset/assets/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />

    @yield('css')

   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        @include('admin/layouts/header')
        <!-- end navbar top -->

        <!-- navbar side -->    	<!-- PHẦN admin-menu.blade.php -->
        @include('admin/layouts/menu')
        <!-- end navbar side -->
		
		
        
						<!-- PHẦN dashboard.blade.php  -->
        <!--  page-wrapper -->
            @yield('content')
        <!-- end page-wrapper -->
		
		

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('admin_asset/assets/plugins/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/pace/pace.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/scripts/siminta.js') }}"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="{{ asset('admin_asset/assets/plugins/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/plugins/morris/morris.js') }}"></script>
    <script src="{{ asset('admin_asset/assets/scripts/dashboard-demo.js') }}"></script>
    

    <script type="text/javascript" language="javascript" src="{{ asset('ckeditor/ckeditor.js') }}" ></script>
    <script type="text/javascript" language="javascript" src="{{ asset('ckfinder/ckfinder.js') }}" ></script>
    
   @yield('script')
</body>

</html>
