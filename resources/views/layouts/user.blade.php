<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    {{-- <link href="{{ asset('css/user/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/jquery.scrolling-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" rel="stylesheet">
    <link href="{{ asset('css/user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/responsive.css') }}" rel="stylesheet">

</head>
<body> 
 {{-- Admin Header Starts --}}
      @include('partials/user_header')
 {{-- Admin Header Ends --}}

 <div class="mb_toggle_hide">  
    
     @yield('content')

 {{-- Admin Footer Starts --}}
      @include('partials/user_footer')
 {{-- Admin Footer Ends --}}

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/user/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/user/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/validate.min.js') }}"></script>    
    <script src="{{ asset('js/star-rating.js') }}"></script> 
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
    <script src="{{ asset('js/user/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/user/jquery.scrolling-tabs.js') }}"></script>
    <script src="{{ asset('js/user/designer_custom.js') }}"></script>
     <script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
    <script src="{{ asset('js/user/user.js') }}"></script>

    @yield('custom_scripts')
</div>
</body>
</html>
