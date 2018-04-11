@extends('layouts.user')
@section('content')
<div class="cstm_banner business-banner-inner"></div>
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
                  <div class="item"><img src="{{ asset('uploads/businessAvatars/no_picture.png') }}"></div>
                  @endif
               </div>
               <div class="addresswrapper">
                  @php
                  $addressArray = explode(',', $businessDetail->address);
                  @endphp                    
                  <h4>{{ $businessDetail->name }}</h4>
                  <p>{{ $addressArray[0] }}<br/>{{ $addressArray[1] }}, {{ $addressArray[2] }} {{ $businessDetail->zipcode }}</p>
                  <p><span>Phone:</span> <a href="tele:{{ $businessDetail->phone_number }}">{{ $businessDetail->phone_number }}</a><br/>
                     <span>Email:</span> <a href="mailto:{{ $businessDetail->email }}">{{ $businessDetail->email }}</a><br/>
                     <span>Website:</span> <a class="web-detail" target="_blank" href="{{ $businessDetail->website }}">{{ $businessDetail->website }}</a>
                  </p>
                  <a href="javascript:void(0)" class="read-btn">Send it to your phone</a>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="addresscontainer">
                  <div id='gmap_canvas' style='height:280px;'></div>
                  <div class="addresscontent">
                     <h4>Show your love</h4>
                     <ul class="social-icons">
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-yauzer.png') }}" alt="Yauzer"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-heart.png') }}" alt="Heart"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-fb.png') }}" alt="Facebook"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-twitter.png') }}" alt="Twitter"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-instagram.png') }}" alt="Instagram"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-gplus.png') }}" alt="Google Plus"/></a></li>
                        <li><a href="javascript:void(0)"><img src="{{ asset('images/icon-youtube.png') }}" alt="Youtube"/></a></li>
                     </ul>
                     <div class="opening-timing">
                        <h4>If it is during business hours for the day of the week:</h4>
                        <div class="table-responsive">
                           <table class="table">
                              @if(sizeof($businessDetail->business_hour))
                              <tr>
                                 <td>Sunday</td>
                                 @if($businessDetail->business_hour->sun_status == true)
                                 <td>{{ $businessDetail->business_hour->sun_open }} - {{ $businessDetail->business_hour->sun_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Monday</td>
                                 @if($businessDetail->business_hour->mon_status == true)
                                 <td>{{ $businessDetail->business_hour->mon_open }} - {{ $businessDetail->business_hour->mon_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Tuesday</td>
                                 @if($businessDetail->business_hour->tue_status == true)
                                 <td>{{ $businessDetail->business_hour->tue_open }} - {{ $businessDetail->business_hour->tue_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Wednesday</td>
                                 @if($businessDetail->business_hour->wed_status == true)
                                 <td>{{ $businessDetail->business_hour->wed_open }} - {{ $businessDetail->business_hour->wed_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Thursday</td>
                                 @if($businessDetail->business_hour->thur_status == true)
                                 <td>{{ $businessDetail->business_hour->thur_open }} - {{ $businessDetail->business_hour->thur_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Friday</td>
                                 @if($businessDetail->business_hour->fri_status == true)
                                 <td>{{ $businessDetail->business_hour->fri_open }} - {{ $businessDetail->business_hour->fri_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              <tr>
                                 <td>Saturday</td>
                                 @if($businessDetail->business_hour->sat_status == true)
                                 <td>{{ $businessDetail->business_hour->sat_open }} - {{ $businessDetail->business_hour->sat_close }}</td>
                                 <td class="greencolor">Open</td>
                                 @else
                                 <td class="redcolor">Closed</td>
                                 @endif
                              </tr>
                              @else
                               No Business hours found for this business
                              @endif
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-8">
               <div class="left-content">
                  @if(@sizeof($businessDetail->description))
                   {!!html_entity_decode($businessDetail->description)!!}
                  @else
                   <p>No Description found for this business.</p>
                  @endif

                  <h4>Specialities</h4>
                   @if(sizeof($businessDetail->business_specialities))
                     <ul class="bulletlists">
                        @foreach($businessDetail->business_specialities as $loopingSpecialities)
                        <li>{{ $loopingSpecialities->name }}</li>
                        @endforeach
                     </ul>
                   @else
                    <p>No Speciality found for this business.</p>
                   @endif

                  <h4>More Info:</h4>
                  @if(sizeof($businessDetail->business_more_info))
                     <ul class="checklists">
                        @foreach($businessDetail->business_more_info as $loopingBusinessInfo)
                        <li>{{ $loopingBusinessInfo->businessInfo->name }}</li>
                        @endforeach
                     </ul>
                  @else
                     <p>No More Info found for this business.</p>
                  @endif   
               </div>
            </div>
            <div class="col-sm-4">
               <div class="right-section">
                  <div class="bluebox">
                  </div>
                  <h4>You might also be interested in...</h4>
                  @if(sizeof($interestedBusiness))
                  @foreach($interestedBusiness as $loopingInterstedBusiness)
                  <div class="business-box">
                     <img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $loopingInterstedBusiness->avatar }}" style="height: 45px; width: 45px;">
                     <li>{{ $loopingInterstedBusiness->category->name }}</li>
                     <li>{{ $loopingInterstedBusiness->name }}</li>
                     <li>{{ $loopingInterstedBusiness->address }}</li>
                     <li>{{ $loopingInterstedBusiness->phone_number }}</li>
                     <li>{{ $loopingInterstedBusiness->email }}</li>
                     <li>{{ $loopingInterstedBusiness->website }}</li>
                  </div>
                  @endforeach
                  @else
                   No Interested Business Yet. 
                  @endif
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="commentbox">
                  <div class="row">
                     <div class="col-sm-12">
                        <h5>Read what they are saying...</h5>
                     </div>
                     <div class="col-sm-7">
                        <h4>This business has been Yauzered 17 times.</h4>
                     </div>
                     <div class="col-sm-5">
                        <div class="yauzeredtime">
                           <div class="totalyauzered">
                              <span>17</span>
                           </div>
                           <ul class="yauzeredtime-status">
                              <li><img src="{{ asset('images/yauzer-Y.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-A.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-U.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-Z.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-E.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-R.png') }}" alt="" /></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <ul class="commentboxlist">
                           <li>
                              <figure><img src="{{ asset('images/james-dean.jpg') }}" alt="James Dean"/></figure>
                              <div class="commentbox-content">
                                 <h5 class="authorname">James Dean</h5>
                                 <div class="star-rating">
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o"></a>
                                 </div>
                                 <p>Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accumsan nec ipsum ut maximus.</p>
                              </div>
                           </li>
                           <li>
                              <figure><img src="{{ asset('images/sean-bean.jpg') }}" alt="Sean Bean"/></figure>
                              <div class="commentbox-content">
                                 <h5 class="authorname">Sean Bean</h5>
                                 <div class="star-rating">
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o"></a>
                                 </div>
                                 <p>Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accumsan nec ipsum ut maximus.</p>
                              </div>
                           </li>
                           <li>
                              <figure><img src="{{ asset('images/james-dean.jpg') }}" alt="James Dean"/></figure>
                              <div class="commentbox-content">
                                 <h5 class="authorname">James Dean</h5>
                                 <div class="star-rating">
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o"></a>
                                 </div>
                                 <p>Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accumsan nec ipsum ut maximus.</p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="commentbox">
                  <div class="row">
                     <div class="col-sm-12">
                        <h5>Read what they are saying...</h5>
                     </div>
                     <div class="col-sm-7">
                        <h4>This business has been Yauzered 4 times.</h4>
                     </div>
                     <div class="col-sm-5">
                        <div class="yauzeredtime">
                           <div class="totalyauzered">
                              <span>4</span>
                           </div>
                           <ul class="yauzeredtime-status">
                              <li><img src="{{ asset('images/yauzer-Y.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-A.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-U.png') }}" alt="" /></li>
                              <li><img src="{{ asset('images/yauzer-Z.png') }}" alt="" /></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <ul class="commentboxlist">
                           <li>
                              <figure><img src="{{ asset('images/james-dean.jpg') }}" alt="James Dean"/></figure>
                              <div class="commentbox-content">
                                 <h5 class="authorname">James Dean</h5>
                                 <div class="star-rating">
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o"></a>
                                 </div>
                                 <p>Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accumsan nec ipsum ut maximus.</p>
                              </div>
                           </li>
                           <li>
                              <figure><img src="{{ asset('images/sean-bean.jpg') }}" alt="Sean Bean"/></figure>
                              <div class="commentbox-content">
                                 <h5 class="authorname">Sean Bean</h5>
                                 <div class="star-rating">
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o active"></a>
                                    <a href="javascript:void(0)" class="fa fa-star-o"></a>
                                 </div>
                                 <p>Pellentesque lacinia sem eget felis consectetur aliquam. Nam non suscipit libero. Nullam leo ante, hendrerit nec eleifend eu, lobortis eget nunc. Donec sed dignissim ipsum. Pellentesque accumsan nec ipsum ut maximus.</p>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('custom_scripts')
 
<script type='text/javascript'>
   $(document).ready(function(){

   function init_map(){


      var myOptions = { zoom:10,center:new google.maps.LatLng({{ $businessDetail->latitude }},{{ $businessDetail->longitude }}),mapTypeId: google.maps.MapTypeId.ROADMAP };

      map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);

      marker = new google.maps.Marker({map: map, position: new google.maps.LatLng({{ $businessDetail->latitude }},{{ $businessDetail->longitude}})});

      infowindow = new google.maps.InfoWindow({content:'@if(@sizeof($businessDetail))<img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $businessDetail->avatar }}" style="height: 45px; width: 45px;">{{ $businessDetail->name }}</br>{{ $businessDetail->address }} @endif'});

      google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);

      });infowindow.open(map,marker);
      }
        google.maps.event.addDomListener(window, 'load', init_map);

   });
                     
</script> 
@endsection
