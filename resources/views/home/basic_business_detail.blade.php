@extends('layouts.user')
@section('content')

@php
 use Carbon\Carbon;
@endphp

<div class="cstm_banner business-banner-inner"></div>
<div class="youzer-profile-details">
   <div class="container">
      <div class="listing-pageview">
         <div class="row">
            <div class="col-sm-6">
               <div id="profile-detail" class="owl-carousel owl-theme">
{{--                   @if(@sizeof($businessDetail->business_pictures))
                  @foreach($businessDetail->business_pictures as $loopingPictures)
                  <div class="item"><img src="/uploads/businessAvatars/{{ $loopingPictures->avatar }}"></div>
                  @endforeach
                  @else --}}
                  <div class="item no-picutre"><img src="{{ asset('uploads/siteCMSAvatars/'.$businessCMSdata->picture_coming_soon) }}"></div>
{{--                   @endif --}}
               </div>
               <div class="addresswrapper no-picture-content ">                  
                  <h4>{{ $businessDetail->name }}</h4>
                  <p>{{ $businessDetail->address }}<br/>{{ $businessDetail->city }}, {{ $businessDetail->state }} {{ $businessDetail->zipcode }}</p>
                  <p><span>Phone:</span> <a href="tele:{{ $businessDetail->phone_number }}">{{ $businessDetail->phone_number }}</a>
                  </p>

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
                        <li><a target="_blank" href="{{ Share::load(Request::url(), html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [$businessDetail->name, $businessDetail->slug], $socialShareCms->description_ckeditor))))->facebook() }}"><img src="{{ asset('images/icon-fb.png') }}" alt="Facebook"/></a></li>
                        <li><a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [$businessDetail->name, $businessDetail->slug], $socialShareCms->description_ckeditor))))->twitter() }}"><img src="{{ asset('images/icon-twitter.png') }}" alt="Twitter"/></a></li>
                        <li><a target="_blank" href="{{ Share::load(Request::url(), html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [$businessDetail->name, $businessDetail->slug], $socialShareCms->description_ckeditor))))->gplus() }}"><img src="{{ asset('images/icon-gplus.png') }}" alt="Google Plus"/></a></li>
                        <li><a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [$businessDetail->name, $businessDetail->slug], $socialShareCms->description_ckeditor))))->linkedin() }}"><img src="{{ asset('images/linkedin-icon.png') }}" alt="Linkedin"/></a></li>
                        <li><a target="_blank" href="{{ Share::load('', html_entity_decode(strip_tags(str_replace(['{business_name}','{business_slug}']  , [$businessDetail->name, $businessDetail->slug], $socialShareCms->description_ckeditor))))->pinterest() }}"><img src="{{ asset('images/icon-Pinterest.png') }}" alt="Pinterest"/></a></li>
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

                  </div>
               </div>
            </div>
            <div class="basic-button-container">
                  <a href="{{ route('user.yauzer_named_business',['slug' => $businessDetail->slug]) }}" class="read-btn">Yauzer this Biz</a>
</div>
         </div>
         <div class="row">
            <div class="col-sm-8">
               <div class="left-content">
                 
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
         </div>
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
@endsection
