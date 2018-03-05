<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/morris/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/credit_card/styles_credit_card.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin_custom.css') }}" rel="stylesheet">

</head>
<body class="skin-black">
    
 {{-- Admin Header Starts --}}
      @include('partials/admin_header')
 {{-- Admin Header Ends --}}

 <div class="wrapper row-offcanvas row-offcanvas-left">
         {{-- Admin Sidebar Partial --}}
              @include('partials/admin_sidebar')
         {{-- Admin Sidebar Partial --}}

        @yield('content')
 </div>


    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="{{ asset('js/admin/jquery-ui-1.10.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>    
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>    
    <script src="{{ asset('js/admin/morris/morris.min.js') }}"></script>
    <script src="{{ asset('js/admin/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/admin/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/admin/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('js/admin/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/admin/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/admin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/admin_app.js') }}"></script>
    <script src="{{ asset('js/admin/admin_dashobard.js') }}"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/admin_custom.js') }}"></script>
    <script src="{{ asset('js/admin/responsive-tabs.js') }}"></script>

    @yield('custom_scripts')

</body>
</html>
