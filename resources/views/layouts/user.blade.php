<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    
    <link rel="shortcut icon" href="{{ asset('img/fav-icon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(\Request::route()->getName() == 'user.business_detail' && $businessDetail->premium_status == true)

        <title>{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $premiumseoDetail->metatitle) }}</title>
        <meta name="title" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $premiumseoDetail->metatitle) }}">
        <meta name="keywords" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $premiumseoDetail->metakeywords) }}">
        <meta name="description" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $premiumseoDetail->metadescription) }}">

    @endif    

    @if(\Request::route()->getName() == 'user.business_detail' && $businessDetail->premium_status == false)

        <title>{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $basicseoDetail->metatitle) }}</title>
        <meta name="title" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $basicseoDetail->metatitle) }}">
        <meta name="keywords" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $basicseoDetail->metakeywords) }}">
        <meta name="description" content="{{ str_replace(['{business_name}', '{category}', '{business_address}', '{zip_code}', '{city}', '{state}'], [$businessDetail->name, $businessDetail->category->name, $businessDetail->address, $businessDetail->zipcode, $businessDetail->city, $businessDetail->state], $basicseoDetail->metadescription) }}">

    @endif    

    @if(\Request::route()->getName() == 'user.search_business')

        <title>{{ str_replace(['{city}', '{state}'], [$formattedAddress[0], $formattedAddress[1]], $cityseoDetail->metatitle) }}</title>
        <meta name="title" content="{{ str_replace(['{city}', '{state}'], [$formattedAddress[0], $formattedAddress[1]], $cityseoDetail->metatitle) }}">
        <meta name="keywords" content="{{ str_replace(['{city}', '{state}'], [$formattedAddress[0], $formattedAddress[1]], $cityseoDetail->metakeywords) }}">
        <meta name="description" content="{{ str_replace(['{city}', '{state}'], [$formattedAddress[0], $formattedAddress[1]], $cityseoDetail->metadescription) }}">

    @endif    

    @if(\Request::route()->getName() == 'user.business_by_category')

        <title>{{ str_replace(['{category}', '{city}', '{state}'], [$businessCategory->name, $location->city, $location->state_name], $categoryseoDetail->metatitle) }}</title>
        <meta name="title" content="{{ str_replace(['{city}', '{state}'], [$businessCategory->name, $location->city, $location->state_name], $categoryseoDetail->metatitle) }}">
        <meta name="keywords" content="{{ str_replace(['{city}', '{state}'], [$businessCategory->name, $location->city, $location->state_name], $categoryseoDetail->metakeywords) }}">
        <meta name="description" content="{{ str_replace(['{city}', '{state}'], [$businessCategory->name, $location->city, $location->state_name], $categoryseoDetail->metadescription) }}">

    @endif    

    @if(\Request::route()->getName() == 'home.welcome')

        <title>{{ $homeseoDetail->metatitle }}</title>
        <meta name="title" content="{{ $homeseoDetail->metatitle }}">
        <meta name="keywords" content="{{ $homeseoDetail->metakeywords }}">
        <meta name="description" content="{{ $homeseoDetail->metadescription }}">

    @endif
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    {{-- <link href="{{ asset('css/user/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/star-rating.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/jquery.scrolling-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/owl.carousel.min1.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/user/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/responsive.css') }}" rel="stylesheet">

</head>
<body class="{{ (\Request::route()->getName() == 'home.welcome') ? '' : 'inner-pages' }}"> 
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
    <script src="{{ asset('js/bootstrap-formhelpers-phone.js') }}"></script>  
    <script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
    <script src="{{ asset('js/admin/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>     
    <script src="{{ asset('js/user/owl.carousel.js') }}"></script>
    {{--    <script src="{{ asset('js/user/owl.carousel.min.js') }}"></script> --}}
    <script src="{{ asset('js/user/jquery.scrolling-tabs.js') }}"></script>
    <script src="{{ asset('js/user/designer_custom.js') }}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0fh0XyC8Pr0xbdKsTfu8Zl40u8fiqOpQ&libraries=places"></script>
    @if(Auth::check() && Auth::user()->isUser())
      <script src="{{ asset('js/user/user.js') }}"></script>
    @endif

    @yield('custom_scripts')
</div>
</body>
</html>
