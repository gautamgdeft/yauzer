@extends('layouts.user')
@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="cstm_banner business-banner-inner" style="background-image: url({{ asset('uploads/siteCMSAvatars/'.$businessCMSdata->default_bg_image) }});">
   <div class="container">
      <div class="search-wrapper">
         <div class="banner-search-form">
            <div class="row">
               <div class="col-sm-6 col-xs-12">
                  <h1>{{ $businessDetail->name }}</h1>
               </div>
               <div class="col-sm-6 col-xs-12">
                  <form name="search-form" id="search-form" method="get" action="{{ route('user.search_business') }}">
                     <div class=" form-group"> 
                        <input type="text" name="search_terms" placeholder="Search" required>
                     </div>
                     <div class=" form-group"> 
                        <input type="text" id="address" name="geo_location_terms" placeholder="Location" required>
                     </div>
                     <div class=" form-group"> 
                        <button type="submit" class="search-btn">Search <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                     </div>
                  </form>   
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="youzer-profile-details">
<div class="container">
<div class="listing-pageview">
<div class="row">
<div class="col-sm-6">
<div id="profile-detail" class="owl-carousel owl-theme">
@if(@sizeof($businessDetail->business_pictures))
@foreach($businessDetail->business_pictures as $loopingPictures)
<div class="item"><img src="/uploads/businessAvatars/{{ $loopingPictures->avatar }}"></div>
@endforeach
@else
<div class="item no-picutre"><img src="{{ asset('uploads/businessAvatars/no_picture.png') }}"></div>
@endif
</div>
<div class="addresswrapper @if(!@sizeof($businessDetail->business_pictures)) no-picture-content @endif">                  
<h4>{{ $businessDetail->name }}</h4>
<p>{{ $businessDetail->address }}<br/>{{ $businessDetail->city }}, {{ $businessDetail->state }} {{ $businessDetail->zipcode }}</p>
<p><span>Phone:</span> <a href="tele:{{ $businessDetail->phone_number }}">{{ $businessDetail->phone_number }}</a><br/>
<span>Email:</span> <a href="mailto:{{ $businessDetail->email }}">{{ $businessDetail->email }}</a><br/>
<span>Website:</span> <a class="web-detail" rel="nofollow" target="_blank" href="{{ $businessDetail->website }}">{{ $businessDetail->website }}</a>
</p>
<a data-toggle="modal" data-target="#sendDirections" href="javascript:void(0)" class="read-btn">Send me directions</a>
<div id="msgs">
@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
</div>
</div>
</div>
<div class="col-sm-6">
<div class="addresscontainer">
<div id='gmap_canvas' style='height:280px;'></div>
<div class="addresscontent">
<h4>Show your love</h4>
<div id="lovemsz">
</div>                     
<ul class="social-icons">
<li><a href="{{ route('user.yauzer_business') }}"><img src="{{ asset('images/icon-yauzer.png') }}" alt="Yauzer"/></a></li>
<li><a data-toggle="tooltip" title="Business love" href="javascript:void(0)" id="loveBusiness" data-id="{{ $businessDetail->id }}"><img src="{{ asset('images/icon-heart.png') }}" alt="Heart"/><span class="love_{{ $businessDetail->id }} {{ $businessDetail->love > 9? 'cstm-position' : '' }}">{{ $businessDetail->love }}</span></a></li>
<li><a target="_blank" href="{{ Share::load(Request::url(), "Check this out Business $businessDetail->name")->facebook() }}"><img src="{{ asset('images/icon-fb.png') }}" alt="Facebook"/></a></li>
<li><a target="_blank" href="{{ Share::load(Request::url(), "Check this out Business $businessDetail->name")->twitter() }}"><img src="{{ asset('images/icon-twitter.png') }}" alt="Twitter"/></a></li>
<li><a target="_blank" href="{{ Share::load(Request::url(), "Check this out Business $businessDetail->name")->gplus() }}"><img src="{{ asset('images/icon-gplus.png') }}" alt="Google Plus"/></a></li>
<li><a target="_blank" href="{{ Share::load(Request::url(), "Check this out Business $businessDetail->name")->linkedin() }}"><img src="{{ asset('images/linkedin-icon.png') }}" alt="Linkedin"/></a></li>
<li><a target="_blank" href="{{ Share::load(Request::url(), "Check this out Business $businessDetail->name")->pinterest() }}"><img src="{{ asset('images/icon-Pinterest.png') }}" alt="Pinterest"/></a></li>
</ul>
@if(sizeof($businessDetail->yauzers))
<div class="business-times">
<p>This business has been</p>
<ul>
<li><span><img src="{{ asset('images/yauzer-Y.png') }}" alt="" /></span></li>
@if($businessDetail->yauzers->count() >= 2)<li><span><img src="{{ asset('images/yauzer-A.png') }}" alt="" /></span></li> @endif
@if($businessDetail->yauzers->count() >= 3)<li><span><img src="{{ asset('images/yauzer-U.png') }}" alt="" /></span></li> @endif
@if($businessDetail->yauzers->count() >= 4)<li><span><img src="{{ asset('images/yauzer-Z.png') }}" alt="" /></span></li> @endif
@if($businessDetail->yauzers->count() >= 5)<li><span><img src="{{ asset('images/yauzer-E.png') }}" alt="" /></span></li> @endif
@if($businessDetail->yauzers->count() >= 6)<li><span><img src="{{ asset('images/yauzer-R.png') }}" alt="" /></span></li> @endif
</ul>
<span class="times-number">{{ $businessDetail->yauzers->count() }}</span>
<span class="times-times">times</span>
</div> 
@endif
@php
$currentTime=Carbon::now();
$openTime  = DateTime::createFromFormat('H:i a', $newbusinessHour[$currentdayname.'_'.'open']);
$closeTime = DateTime::createFromFormat('H:i a', $newbusinessHour[$currentdayname.'_'.'close']);
@endphp
@if($newbusinessHour[$currentdayname.'_'.'status'] == true)
<p class="business-timing"><span class="{{ ($currentTime > $openTime) && ($currentTime < $closeTime)? 'business-span-green' : 'business-span-red' }}"><i class="fa fa-clock-o"></i> {{ ($currentTime > $openTime) && ($currentTime < $closeTime)? 'Open Now' : 'Closed Now' }}</span> Today&nbsp;&nbsp;&nbsp;&nbsp;{{ $newbusinessHour[$currentdayname] }}</p>
@endif
@if(sizeof($businessDetail->business_hour))
<div class="opening-timing">
<h4>Business Hours</h4>
<div class="table-responsive">
<table class="table">
<tr>
<td>Sunday</td>
@if($businessDetail->business_hour->sun_status == true)
<td>{{ $businessDetail->business_hour->sun_open }} - {{ $businessDetail->business_hour->sun_close }}</td>
@endif
</tr>
<tr>
<td>Monday</td>
@if($businessDetail->business_hour->mon_status == true)
<td>{{ $businessDetail->business_hour->mon_open }} - {{ $businessDetail->business_hour->mon_close }}</td>
@endif
</tr>
<tr>
<td>Tuesday</td>
@if($businessDetail->business_hour->tue_status == true)
<td>{{ $businessDetail->business_hour->tue_open }} - {{ $businessDetail->business_hour->tue_close }}</td>
@endif
</tr>
<tr>
<td>Wednesday</td>
@if($businessDetail->business_hour->wed_status == true)
<td>{{ $businessDetail->business_hour->wed_open }} - {{ $businessDetail->business_hour->wed_close }}</td>
@endif
</tr>
<tr>
<td>Thursday</td>
@if($businessDetail->business_hour->thur_status == true)
<td>{{ $businessDetail->business_hour->thur_open }} - {{ $businessDetail->business_hour->thur_close }}</td>
@endif
</tr>
<tr>
<td>Friday</td>
@if($businessDetail->business_hour->fri_status == true)
<td>{{ $businessDetail->business_hour->fri_open }} - {{ $businessDetail->business_hour->fri_close }}</td>
@endif
</tr>
<tr>
<td>Saturday</td>
@if($businessDetail->business_hour->sat_status == true)
<td>{{ $businessDetail->business_hour->sat_open }} - {{ $businessDetail->business_hour->sat_close }}</td>
@endif
</tr>
</table>
</div>
</div>
@endif
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-8">
<div class="left-content">
@if(@sizeof($businessDetail->description))
{!!html_entity_decode($businessDetail->description)!!}
@endif
@if(sizeof($businessDetail->business_specialities))
<h4>Specialities</h4>
<ul class="bulletlists">
@foreach($businessDetail->business_specialities as $loopingSpecialities)
<li>{{ $loopingSpecialities->name }}</li>
@endforeach
</ul>
@endif
@if(sizeof($businessDetail->business_more_info))
<h4>More Info:</h4>
<ul class="checklists">
@foreach($businessDetail->business_more_info as $loopingBusinessInfo)
<li>{{ $loopingBusinessInfo->businessInfo->name }}</li>
@endforeach
</ul>
@endif 
@if(sizeof($businessDetail->discounts))
<div class="bluebox hidden-lg hidden-md">
<h2>{{ $businessDetail->discounts->discount_title }}</h2>
<p>{{ $businessDetail->discounts->description }}</p>
<p class="bluebox-date">Valid thru {{ Carbon::parse($businessDetail->discounts->valid_thru)->format('d/m/y') }}</p>
</div>
@endif
@if(sizeof($businessDetail->yauzers))
<div class="commentbox">
<div class="row">
<div class="col-sm-12">
<h5>Read what they are saying...</h5>
</div>
<div class="col-sm-7">
<h4>This business has been Yauzered {{ $businessDetail->yauzers->count() }} times.</h4>
</div>
<div class="col-sm-5">
<div class="yauzeredtime">
<div class="totalyauzered">
<span>{{ $businessDetail->yauzers->count() }}</span>
</div>
<ul class="yauzeredtime-status">
<li><img src="{{ asset('images/yauzer-Y.png') }}" alt="" /></li>
@if($businessDetail->yauzers->count() >= 2)<li><img src="{{ asset('images/yauzer-A.png') }}" alt="" /></li> @endif
@if($businessDetail->yauzers->count() >= 3)<li><img src="{{ asset('images/yauzer-U.png') }}" alt="" /></li> @endif
@if($businessDetail->yauzers->count() >= 4)<li><img src="{{ asset('images/yauzer-Z.png') }}" alt="" /></li> @endif
@if($businessDetail->yauzers->count() >= 5)<li><img src="{{ asset('images/yauzer-E.png') }}" alt="" /></li> @endif
@if($businessDetail->yauzers->count() >= 6)<li><img src="{{ asset('images/yauzer-R.png') }}" alt="" /></li> @endif
</ul>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<ul class="commentboxlist">
@foreach($businessDetail->yauzers as $loopingYauzers)
<li>
<figure><img src="/uploads/avatars/{{ $loopingYauzers->user->avatar }}" alt="{{ $loopingYauzers->name }}"/></figure>
<div class="commentbox-content">
<h5 class="authorname">{{ $loopingYauzers->user->name }}</h5>
<div class="star-rating">
<a href="javascript:void(0)" class="fa fa-star-o {{ $loopingYauzers->rating >= 1? 'active' : ''}}"></a>
<a href="javascript:void(0)" class="fa fa-star-o {{ $loopingYauzers->rating >= 2? 'active' : ''}}"></a>
<a href="javascript:void(0)" class="fa fa-star-o {{ $loopingYauzers->rating >= 3? 'active' : ''}}"></a>
<a href="javascript:void(0)" class="fa fa-star-o {{ $loopingYauzers->rating >= 4? 'active' : ''}}"></a>
<a href="javascript:void(0)" class="fa fa-star-o {{ $loopingYauzers->rating == 5? 'active' : ''}}"></a>
</div>
<p>{{ $loopingYauzers->yauzer }}</p>
</div>
</li>
@endforeach
</ul>
</div>
</div>
</div>
@endif
</div>
</div>
<div class="col-sm-4">
<div class="right-section">
@if(sizeof($businessDetail->discounts))
<div class="bluebox hidden-sm hidden-xs">
<h2>{{ $businessDetail->discounts->discount_title }}</h2>
<p>{{ $businessDetail->discounts->description }}</p>
<p class="bluebox-date">Valid thru {{ Carbon::parse($businessDetail->discounts->valid_thru)->format('d/m/y') }}</p>
</div>
@endif
@if(sizeof($interestedBusiness))
<h4>You might also be interested in...</h4>
@foreach($interestedBusiness as $loopingInterstedBusiness)
<div class="lawyer-listing business-listing listing-adds">
<figure>
<a href="{{ route('user.business_detail',['slug' => $loopingInterstedBusiness->slug]) }}"  class="red-eyes">
<img src="/uploads/businessAvatars/{{ $loopingInterstedBusiness->avatar }}" alt=""/>
</a>
<figcaption>
<div class="content">
<a href="{{ route('user.business_detail',['slug' => $loopingInterstedBusiness->slug]) }}"><h3>{{ $loopingInterstedBusiness->name }}</h3></a>
<p class="address-text">{{ $loopingInterstedBusiness->address }} {{ $loopingInterstedBusiness->zipcode }}</p>
<p class="address-text adds-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>{{ $loopingInterstedBusiness->phone_number }}</a><a href="tel:{{ $loopingInterstedBusiness->phone_number }}" class="visibile-xs">Call Now</a>
<a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>{{ $loopingInterstedBusiness->email }}</a>
<a href="{{ $loopingInterstedBusiness->website }}" target="_blank"><i class="fa fa-globe"></i>{{ $loopingInterstedBusiness->website }}</a>
</p>
</div>
</figcaption>
</figure>
</div>
@endforeach
@endif
</div>
</div>
</div>
</div>
</div>
</div>
{{-- Send Directions Popup --}}
<div class="modal fade in" id="sendDirections" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">×</button>
<h4 class="modal-title">Get Directions</h4>
</div>
<div class="modal-body">
<form id="get_directions" name="get_directions" method="POST" action="{{ route('user.sendBusinessDirections') }}">
{{ csrf_field() }}
<input type="hidden" name="id" value="{{ $businessDetail->id }}">
<input type="hidden" name="latitude" value="{{ $businessDetail->latitude }}">
<input type="hidden" name="longitude" value="{{ $businessDetail->longitude }}">
<div id="yauzer_div" class="form-group">
<label>Email<span> *</span></label>
<input name="email" id="email" class="form-control" required="required">
</div>
</div>
<div class="modal-footer">
<button type="submit" id="get_direction_btn" onclick="applyValidate(11);" class="btn btn-default">Submit</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
@endsection
@section('custom_scripts')
<script type='text/javascript'>
   function init_map(){
   
   
      var myOptions = { zoom:10,center:new google.maps.LatLng({{ $businessDetail->latitude }},{{ $businessDetail->longitude }}),mapTypeId: google.maps.MapTypeId.ROADMAP, mapTypeControl: true,
      mapTypeControlOptions: {position: google.maps.ControlPosition.LEFT_CENTER} };
   
      map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
   
      marker = new google.maps.Marker({map: map, position: new google.maps.LatLng({{ $businessDetail->latitude }},{{ $businessDetail->longitude}})});
   
      infowindow = new google.maps.InfoWindow({content:'@if(@sizeof($businessDetail))<div class="main_map"><div class="map-img"><img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $businessDetail->avatar }}" style="height: 45px; width: 45px;"></div><div class="map-text"><h4>{{ $businessDetail->name }}</h4><p>{{ $businessDetail->address }}</p><p>{{ $businessDetail->city }}, {{ $businessDetail->state }} {{ $businessDetail->zipcode }}</p></div></div> @endif'});
   
      google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);
   
      });infowindow.open(map,marker);
      }
        google.maps.event.addDomListener(window, 'load', init_map);
   
   $(document).ready(function()
   {
     $('#loveBusiness').click(function()
     {
        var id = $(this).data('id');
        $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
         url: "/love-business",
         type: "post",
         dataType: "JSON",
         data: { 'id': $(this).data('id') },
         success: function(response)
         { 
            if(response.status == 'success') 
            {
              if(parseInt($('.love_'+id).text() + parseInt(1)) > 9 && !$('.love_'+id).hasClass('cstm-position'))
              {
                $('.love_'+id).addClass('cstm-position');
              } 
              $('.love_'+id).text(parseInt($('.love_'+id).text()) + parseInt(1)); 
              $('#lovemsz').html("<div class='alert alert-success'>"+response.msg+"</div>");
              hideSuccessMsz();
   
            }else{
              $('#lovemsz').html("<div class='alert alert-danger'>"+response.msg+"</div>"); 
              hideErrorMsz();
            }
         },
         error: function( response ) 
         {
           if ( response.status === 422 ) 
           {
             $(this).html('Try Again');
             $('#lovemsz').html("<div class='alert alert-danger'>"+response.msg+"</div>");
           }
         }
   
       });           
   
   
     }); 
   
   hideSuccessMsz();
   hideErrorMsz();
   });  
   
   
   function hideSuccessMsz()
   {
   setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 8000);    
   }
   
   function hideErrorMsz()
   {
   setTimeout(function() {
   $('.alert-danger').fadeOut('fast');
   }, 8000);
   }
   
</script> 
<script src="{{ asset('js/user/owl.carousel.min.js') }}"></script>
<script type="text/javascript">
function initialize() 
{
    var input = document.getElementById('address');
    var options = {    
    types: ['geocode'],
    componentRestrictions: {country: ["us", "ca"]}
    };
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };    
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
    });
}
google.maps.event.addDomListener(window, 'load', initialize);   
</script>
@endsection