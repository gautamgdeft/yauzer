@extends('layouts.user')

@section('content')


<!-- banner sec -->
<section class="banner_sec">
   <div class="slider-inner">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
         <!-- Wrapper for slides -->
         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               @if(@sizeof($sliderImages))
               @foreach($sliderImages as $index => $loopingSliderImage)
                  <div class="item {{ $index == 0 ? 'active' : '' }}" style="background-image: url(/uploads/sliderAvatars/{{ $loopingSliderImage->avatar }});">
                     <div class="main-text slider-content">
                        <div class="col-md-12 text-center">
                           <h3>{{ $loopingSliderImage->h3_description }}</h3>
                           <h2>{{ $loopingSliderImage->h2_description }} </h2>
                        </div>
                     </div>
                  </div>
               @endforeach   
               @else
                  <div class="item" style="background-image: url(images/banner-img.jpg);">
                     <div class="main-text slider-content">
                        <div class="col-md-12 text-center">
                           <h3>YOUR DREAM HOME STARTS WITH </h3>
                           <h2>THE RIGHT CONSTRUCTOR </h2>
                        </div>
                     </div>
                  </div>
               @endif   
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <a class="right carousel-control"
               href="#carousel-example-generic" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            </a>
         </div>
         <div class="main-text slider-content banner-form-section">
            <div class="col-md-12 text-center">
               <div class="banner-form">
                  <form>
                     <div class=" form-group"> 
                        <input type="search" placeholder="Search">
                     </div>
                     <div class=" form-group">
                        <select class="selectpicker" title="Location">
                           <option> Lorem</option>
                           <option> Lorem</option>
                           <option> Lorem</option>
                        </select>
                     </div>
                     <div class=" form-group"> 
                        <button class="search-btn">Search <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end banner sec -->

<!-- share sec -->
<section class="share-content">
   <div class="container">
      <div class="row">
         <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 padding0 ">
            <div class="share-content-inner">
               <p>Did you ever a had business that you couldn't wait to tell it to your friends? </p>
               <p>Here you can share it with the world! </p>
               <a href="javascript:;" class="read-btn"> Read more </a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end share sec -->
<!--find your zen start  -->
<section class="yauzer-blog-sec dr-find-sec">
   <div class="text-center heading-text">
      <hr>
      <h2 class="sec-title pos-rel"> FIND  <span>YOUR ZEN</span></h2>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div id="service-carousel" class="owl-carousel owl-theme pos-rel service-carousel ">
               @if(sizeof($businessCategory))
               @foreach($businessCategory as $loopingCategory)
               <div class="item">
                  <div class="services-sec service1">
                     <div class="service-left">
                        <a href="{{ route('user.business_by_category',['slug' => $loopingCategory->slug]) }}">
                        <figure> <img src="/uploads/categoryAvatars/{{ $loopingCategory->avatar }}" alt=""/> </figure></a>
                     </div>
                     <div class="service-right-sec">
                        <a href="{{ route('user.business_by_category',['slug' => $loopingCategory->slug]) }}"><p class="heading-sec"> {{ $loopingCategory->name }}</p></a>
                     </div>
                  </div>
               </div>
               @endforeach
               @else
               <div class="item">
                  <div class="services-sec service5">
                     <div class="service-left">
                        <figure> <img src="{{ asset('images/service-icon2.png') }}" alt=""/> </figure>
                     </div>
                     <div class="service-right-sec">
                        <p class="heading-sec"> LANDSCAPING</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="services-sec service5">
                     <div class="service-left">
                        <figure> <img src="{{ asset('images/service-icon3.png') }}" alt=""/> </figure>
                     </div>
                     <div class="service-right-sec">
                        <p class="heading-sec"> DOC BREATHER</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="services-sec service5">
                     <div class="service-left">
                        <figure> <img src="{{ asset('images/service-icon4.png') }}" alt=""/> </figure>
                     </div>
                     <div class="service-right-sec">
                        <p class="heading-sec"> CONSTRUCTION</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="services-sec service5">
                     <div class="service-left">
                        <figure> <img src="{{ asset('images/service-icon5.png') }}" alt=""/> </figure>
                     </div>
                     <div class="service-right-sec">
                        <p class="heading-sec"> RENOVATIONS</p>
                     </div>
                  </div>
               </div>
               <div class="item">
                  <div class="services-sec service6">
                     <div class="service-left">
                        <figure> <img src="{{ asset('images/service-icon6.png') }}" alt=""/> </figure>
                     </div>
                     <div class="service-right-sec">
                        <p class="heading-sec"> RESTAURANTS</p>
                     </div>
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
<!--find your zen close  -->
<!--Most yauzer Business-->
<section class="business-sec gallery-sec">
   <div class="text-center heading-text">
      <hr>
      <h2 class="sec-title pos-rel"> MOST  <span>YAUZERED<sup>TM</sup> BUSINESS</span></h2>
   </div>
   <div class="container">
      <div class="row">
         <div class="tab-content">
            <div  role="tabpanel" id="all" class="tab-pane fade in active">
               <div class="container">
                  <div class="slider_sec">
                     <div class="row">
                        @if(sizeof($businesses))
                        @foreach($businesses as $loopingBusiness)
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="business-detail">
                                    <figure>
                                       <img src="/uploads/businessAvatars/{{ $loopingBusiness->avatar }}" alt="img">
                                    </figure>
                                 <div class="business-detail-text">
                                       @php
                                         $addressArray = explode(',', $loopingBusiness->address);
                                       @endphp
                                       <h2>{{ $loopingBusiness->name }}</h2>
                                       <p>{{ $addressArray[0] }} <br>
                                          {{ $addressArray[1] }}, {{ $addressArray[2] }} {{ $loopingBusiness->zipcode }}
                                       </p>
                                       <a href="javascript:void" class="phoneno">Phone: {{ $loopingBusiness->phone_number }}</a>
                                       <span>E-mail:<a href="javascript:void">{{ $loopingBusiness->email }}</a></span>
                                       <span>Web:<a href="javascript:void" class="web">{{ $loopingBusiness->website }}</a></span>
                                    </div>
                                    <a href="{{ route('user.business_detail',['slug' => $loopingBusiness->slug]) }}" class="btn-more">More About This Biz</a> 
                                 </div>
                        </div>
                        @endforeach
                        @endif                                                                                                                                                                    
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-sm-12 text-center">
            <!--<a href="javascript:;" class="read-btn"> View more </a>-->
         </div>
      </div>
   </div>
   <div class="business-slider-mobile">
      <ul class="business-slider-list">
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-1.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a class="web" href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-2.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-3.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-4.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-5.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-6.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-7.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
         <li>
            <div class="business-detail">
               <figure>
                  <img src="images/business-tab-8.png" alt="img">
               </figure>
               <div class="business-detail-text">
                  <h2>Specialized Handiman Services</h2>
                  <p>1234 Main Street SW <br>
                     Miami Lakes, FL 33015
                  </p>
                  <a href="javascript:void" class="phoneno">Phone: 305-259-8549</a>
                  <span>E-mail:<a href="javascript:void">info@handiman.com</a></span>
                  <span>Web:<a href="javascript:void">www.handiman.com</a></span>
               </div>
               <a href="javascript:;" class="btn-more">More About This Biz</a> 
            </div>
         </li>
      </ul>
   </div>
</section>
<!--blog sec -->
<section class="yauzer-blog-sec">
   <div class="text-center heading-text">
      <hr>
      <h2 class="sec-title pos-rel"> YAUZER BLOG: <span class="block">POPULAR ARTICLES AND INTERVIEWS</span></h2>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div id="blog-carousel">
               <div class="owl-carousel owl-theme pos-rel">
                  <div class="item">
                     <div class="blog-image pos-rel">
                        <img src="{{ asset('images/blog-img-1.png') }}" alt="img">
                        <div class="blog-img-content">
                           <span>25</span>
                           <span>JAN</span>
                           <span>2017</span>
                        </div>
                     </div>
                     <div class="blog-desc">
                        <h4>Landscaping</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
                     </div>
                  </div>
                  <div class="item">
                     <div class="blog-image pos-rel">
                        <img src="{{ asset('images/blog-img-2.png') }}" alt="img">
                        <div class="blog-img-content">
                           <span>26</span>
                           <span>JAN</span>
                           <span>2017</span>
                        </div>
                     </div>
                     <div class="blog-desc">
                        <h4>Design Idea</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
                     </div>
                  </div>
                  <div class="item">
                     <div class="blog-image pos-rel">
                        <img src="{{ asset('images/blog-img-3.png') }}" alt="img">
                        <div class="blog-img-content">
                           <span>27</span>
                           <span>JAN</span>
                           <span>2017</span>
                        </div>
                     </div>
                     <div class="blog-desc">
                        <h4>Hotel Bath Hunt</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
                     </div>
                  </div>
                  <div class="item">
                     <div class="blog-image pos-rel">
                        <img src="{{ asset('images/blog-img-1.png') }}" alt="img">
                        <div class="blog-img-content">
                           <span>28</span>
                           <span>JAN</span>
                           <span>2017</span>
                        </div>
                     </div>
                     <div class="blog-desc">
                        <h4>Landscaping</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="business-slider-mobile">
      <ul class="business-slider-list blog-slider-list">
         <li>
            <div class="blog-image pos-rel">
               <img src="images/blog-img-1.png" alt="img">
               <div class="blog-img-content">
                  <span>25</span>
                  <span>JAN</span>
                  <span>2017</span>
               </div>
            </div>
            <div class="blog-desc">
               <h4>Landscaping</h4>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
            </div>
         </li>
         <li>
            <div class="blog-image pos-rel">
               <img src="images/blog-img-2.png" alt="img">
               <div class="blog-img-content">
                  <span>26</span>
                  <span>JAN</span>
                  <span>2017</span>
               </div>
            </div>
            <div class="blog-desc">
               <h4>Design Idea</h4>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
            </div>
         </li>
         <li>
            <div class="blog-image pos-rel">
               <img src="images/blog-img-3.png" alt="img">
               <div class="blog-img-content">
                  <span>27</span>
                  <span>JAN</span>
                  <span>2017</span>
               </div>
            </div>
            <div class="blog-desc">
               <h4>Hotel Bath Hunt</h4>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiu <a href="javascript:void(0);">Read More</a></p>
            </div>
         </li>
      </ul>
   </div>
</section>
<!-- Blog Ends -->

@endsection

@section('custom_scripts')

<script type="text/javascript">
 

</script>

@endsection