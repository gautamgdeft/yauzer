@extends('layouts.user')
@section('content')

<div class="container">
   <div id="msgs">
    @if(session('success'))
     <div class="alert alert-success">
     {{ session('success') }}
     </div>
    @endif
   </div>

   <div class="row">
      <div class="lawyer-listing business-listing">
         <div class="col-md-9 col-sm-12">              
            <div class="row">
               @if(@sizeof($businesses))
               @foreach($businesses as $loopingBusiness)
               @if($loopingBusiness->premium_status == true)	
               <div class="col-sm-4 col-xs-6 premium_cstm_biz">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span class="sam"><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img class="thumnil-img" style="width:236px; height:213px;" src="/uploads/businessAvatars/{{ $loopingBusiness->avatar }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> {{ $loopingBusiness->name }} </h3>
                           <p class="address-text">{{ $loopingBusiness->address }}<br/>{{ $loopingBusiness->city }}, {{ $loopingBusiness->state }} {{ $loopingBusiness->zipcode }}</p>
                           <p class="address-text"><a href="tel:{{ $loopingBusiness->phone_number }}" class="hidden-xs"><i class="fa fa-phone"></i>{{ $loopingBusiness->phone_number }}</a><a href="tel:{{ $loopingBusiness->phone_number }}" class="visibile-xs">Call Now</a><br/>

                              <a href="mailto:{{ $loopingBusiness->email }}"><i class="fa fa-envelope"></i>{{ $loopingBusiness->email }}</a><br/>
                              <a href="{{ $loopingBusiness->website }}" target="_blank"><i class="fa fa-globe"></i>{{ $loopingBusiness->website }}</a>
                           </p>
                           <p>{!! str_limit(html_entity_decode($loopingBusiness->description), 100) !!}</p>
                           <div class="wrap_cstm_directions">
                           <ul class="cstm-cat-search">
                              <p class="address-text"> <a data-toggle="modal" data-target="#sendDirections{{ $loopingBusiness->id }}" href="javascript:void();"> Directions </a></p>
                           </ul>
                           <a href="{{ route('user.business_detail',['slug' => $loopingBusiness->slug]) }}" class="btn-more"> More About This Biz </a>
                           </div>
                        </div>
                     </figcaption>
                  </figure>
               </div>


               {{-- Send Directions Popup --}}
               <div class="modal fade in" id="sendDirections{{ $loopingBusiness->id }}" role="dialog">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">×</button>
                           <h4 class="modal-title">Get Directions</h4>
                        </div>
                        <div class="modal-body">
                           <form id="{{ $loopingBusiness->id }}" name="get_directions" method="POST" action="{{ route('user.sendBusinessDirections') }}">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value="{{ $loopingBusiness->id }}">
                              <input type="hidden" name="latitude" value="{{ $loopingBusiness->latitude }}">
                              <input type="hidden" name="longitude" value="{{ $loopingBusiness->longitude }}">
                              <div id="yauzer_div" class="form-group">
                                 <label>Email<span> *</span></label>
                                 <input name="email" id="email" class="form-control" required="required">
                              </div>
                        </div>
                        <div class="modal-footer">
                           <button type="submit" id="get_direction_btn" onclick="applyEmailValidate({{ $loopingBusiness->id }});" class="btn btn-default">Submit</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                         </form>
                     </div>
                  </div>
               </div>

               @endif
               @endforeach
               @else
                 <img src="/images/Yauza-Pardon-Us.png">
                 <p>We’re waiting for someone’s favorite in this {{ $businessCategory->name }} category. Why not Yauz yours!</p>
               @endif

               <div class="col-sm-12" style="float: left;">
                  <div class="row paddingTop">
                     @if(@sizeof($businesses))
                      @foreach($businesses as $loopingBusiness)                     
                      @if($loopingBusiness->premium_status == false)
                     <div class="col-sm-4">
                        <figure>
                          <img style="width:236px; height:213px;" src="{{ asset('uploads/siteCMSAvatars/'.$businessCMSdata->picture_coming_soon) }}">                          
                           <figcaption>
                              <div class="content">
                                 <a href="{{ route('user.business_detail',['slug' => $loopingBusiness->slug]) }}"><h3> {{ $loopingBusiness->name }}</h3></a>
                                 <p class="address-text">{{ $loopingBusiness->address }}<br/>{{ $loopingBusiness->city }}, {{ $loopingBusiness->state }} {{ $loopingBusiness->zipcode }}</p>
                                 <a href="{{ route('user.business_detail',['slug' => $loopingBusiness->slug]) }}" class="btn-more"> Yauzer This Biz </a>
                              </div>
                           </figcaption>
                        </figure>
                     </div>
                     @endif
                      @endforeach
                      @endif
                  </div>
               </div>
               <div class="col-sm-12 text-center pagination-ceontent margin-bottom" >
{{--                   <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                     <li class="page-item active"><a class="page-link" href="#">1</a></li>
                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <li class="page-item "><a class="page-link" href="#">4</a></li>
                     <li class="page-item"><a class="page-link" href="#">5</a></li>
                     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                  </ul> --}}
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-12">
            <div class="aside_sec hidden-xs">
               <img src="{{ asset('uploads/siteCMSAvatars/'.$resultcms->default_bg_image) }}" alt=""/>
               <div class="img_content">
                  {!! $resultcms->description_ckeditor !!}
                  <a href="{{ $resultcms->second_section }}" class="learn-more">{{ $resultcms->first_section }}  <img src="{{ asset('images/search-btn-icon.png') }}"></a>  
               </div>
            </div>
            <div class="aside_sec">                    
            @if(@sizeof($businesses))
               <div id="mapCanvas" style="width: 100%; height:262px;"></div>
            @endif
            </div>
         </div>
      </div>
   </div>
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>


@endsection

@section('custom_scripts')

<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {position: google.maps.ControlPosition.LEFT_BOTTOM} 
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
      @if(@sizeof($businesses))
        @foreach($businesses as $loopingBusiness)
         @php
           $addressArray = explode(',', $loopingBusiness->address);
         @endphp
        ['{{ $loopingBusiness->name }}, {{ $loopingBusiness->state }}', {{ $loopingBusiness->latitude }}, {{ $loopingBusiness->longitude }}],
        @endforeach
      @endif
    ];
                        
    // Info window content
    var infoWindowContent = [
      @if(@sizeof($businesses))
        @foreach($businesses as $loopingBusiness)    
        ['<div class="info_content">' +
        '<h3>{{ $loopingBusiness->name }}</h3>' +
        '<p>{{ $loopingBusiness->address }}, {{ $loopingBusiness->city }}, {{ $loopingBusiness->state }} {{ $loopingBusiness->zipcode }}</p>' + '</div>'],
        @endforeach
      @endif
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);



// Get the modal
// var modal = document.getElementById('myModal');

// var modalImg = document.getElementById("img01");
// var captionText = document.getElementById("caption");

// $(document).ready(function(){
// $('.sam').click(function()
// {
//     modal.style.display = "block";
//     modalImg.src = $(this).next().attr('src');
//     captionText.innerHTML = $(this).parent().next().find('h3').text();      
// });


// // When the user clicks on <span> (x), close the modal
// $('.close').click(function(){
//     modal.style.display = "none";
// });
// });
</script>

@endsection