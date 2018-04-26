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
    <link href="{{ asset('css/admin/easy-responsive-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/datatables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/credit_card/styles_credit_card.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/owner/owner_custom.css') }}" rel="stylesheet">

</head>
<body class="skin-black">
    
 {{-- Admin Header Starts --}}
      @include('partials/owner_header')
 {{-- Admin Header Ends --}}

 <div class="wrapper row-offcanvas row-offcanvas-left">
         {{-- Admin Sidebar Partial --}}
              @include('partials/owner_sidebar')
         {{-- Admin Sidebar Partial --}}

        @yield('content')
 </div>


    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="{{ asset('js/admin/jquery-ui-1.10.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/admin/easyResponsiveTabs.js') }}"></script>   
    <script src="{{ asset('js/validate.min.js') }}"></script>    
    <script src="{{ asset('js/star-rating.js') }}"></script>    
    <script src="{{ asset('js/bootstrap-formhelpers-phone.js') }}"></script>   
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>    
    <script src="{{ asset('js/admin/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/admin/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('js/admin/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('js/admin/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/admin/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('js/admin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/admin_app.js') }}"></script>
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/admin/responsive-tabs.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0fh0XyC8Pr0xbdKsTfu8Zl40u8fiqOpQ&libraries=places"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>    
    <script src="{{ asset('js/owner/owner.js') }}"></script>

    @yield('custom_scripts')

</body>
</html>
