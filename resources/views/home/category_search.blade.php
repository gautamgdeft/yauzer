@extends('layouts.user')
@section('content')



<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <div class="location-search ">
            <div class="col-sm-4">
               <h2> Miami, FL Attorneys </h2>
               <h5> Personal Injury Lawyer </h5>
               <a href="javascript:;"> Change Location </a>
            </div>
            <div class="col-sm-8">
               <form>
                  <ul class="search-bar">
                     <li>
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="Personal Injury Lawyer" />
                        </div>
                     </li>
                     <li>
                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="Location" />
                        </div>
                     </li>
                     <li>
                        <div class="form-group">
                           <input type="submit" class="form-control" value="Search" />
                        </div>
                     </li>
                  </ul>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="lawyer-listing business-listing">
         <div class="col-md-9 col-sm-12">
            <div class="row">
               @if(@sizeof($businesses))
               @foreach($businesses as $loopingBusiness)	
               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="/uploads/businessAvatars/{{ $loopingBusiness->avatar }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> {{ $loopingBusiness->name }} of {{ $loopingBusiness->user->name }} 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>
               @endforeach
               @endif

               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="{{ asset('images/business-listing-img2.jpg') }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> Law Offices of David A.
                              Helfand Attorney at Law 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="{{ asset('images/business-listing-img3.jpg') }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> Law Offices of David A.
                              Helfand Attorney at Law 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="{{ asset('images/business-listing-img4.jpg') }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> Law Offices of David A.
                              Helfand Attorney at Law 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="{{ asset('images/business-listing-img5.jpg') }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> Law Offices of David A.
                              Helfand Attorney at Law 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>
               <div class="col-sm-4 col-xs-6">
                  <figure>
                     <a href="javascript:void(0)"  class="red-eyes">
                     <span><img src="{{ asset('images/red-eyes.png') }}"></span>
                     <img src="{{ asset('images/business-listing-img6.jpg') }}" alt=""/>
                     </a>
                     <figcaption>
                        <div class="content">
                           <h3> Law Offices of David A.
                              Helfand Attorney at Law 
                           </h3>
                           <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                           <p class="address-text"><a href="tel:3051234567" class="hidden-xs"><i class="fa fa-phone"></i>305-123-4567</a><a href="tel:3051234567" class="visibile-xs">Call Now</a><br/>
                              <a href="mailto:david@helfand.com"><i class="fa fa-envelope"></i>david@helfand.com</a><br/>
                              <a href="http://www.helfand.com" target="_blank"><i class="fa fa-globe"></i>helfand.com</a>
                           </p>
                           <p>Injuries Resulting in Death, Auto     accident, Drunk Driving (DUI), Wrongful Death, Nursing Home Neglect, Medical Malpractice, Dog Bites, Slip & Fall    Accidents </p>
                           <span class="lawyer-tag"> <i class="fa fa-tags"> </i> Personal Injury Lawyer </span>
                           <ul>
                              <li> <span> Direction </span> </li>
                              <li>  Coupons</li>
                           </ul>
                           <a href="login.html" class="btn-more"> More About This Biz </a>
                        </div>
                     </figcaption>
                  </figure>
               </div>

               <div class="col-xs-12 visible-xs" style="display: block; position: relative; float: left; right: 0;">
                  <div class="aside_sec">
                     <img src="{{ asset('images/side-business-listing.jpg') }}" alt=""/>
                     <div class="img_content">
                        <h5>Did you ever had a business that you couldn't wait to tell it your friends?</h5>
                        <p>Here you can share it with the world!</p>
                        <a href="javascript:void(0)" class="learn-more">Learn More  <img src="{{ asset('images/search-btn-icon.png') }}"></a>  
                     </div>
                  </div>
               </div>
               <div class="col-sm-12" style="float: left;">
                  <div class="row paddingTop">
                     <div class="col-sm-4">
                        <figure>
                           <figcaption>
                              <div class="content">
                                 <h3> Law Offices of David A.
                                    Helfand Attorney at Law 
                                 </h3>
                                 <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                                 <p class="address-text">
                                 </p>
                                 <a href="login.html" class="btn-more"> Yauzer This Biz </a>
                              </div>
                           </figcaption>
                        </figure>
                     </div>
                     <div class="col-sm-4">
                        <figure>
                           <figcaption>
                              <div class="content">
                                 <h3> Law Offices of David A.
                                    Helfand Attorney at Law 
                                 </h3>
                                 <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                                 <p class="address-text">
                                 </p>
                                 <a href="login.html" class="btn-more"> Yauzer This Biz </a>
                              </div>
                           </figcaption>
                        </figure>
                     </div>
                     <div class="col-sm-4">
                        <figure>
                           <figcaption>
                              <div class="content">
                                 <h3> Law Offices of David A.
                                    Helfand Attorney at Law 
                                 </h3>
                                 <p class="address-text">Law Offices of David A. Helfand Attorney at Law<br/>12345 Main Avenue Miami, FL 33137</p>
                                 <p class="address-text">
                                 </p>
                                 <a href="login.html" class="btn-more">Yauzer This Biz</a>
                              </div>
                           </figcaption>
                        </figure>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 text-center pagination-ceontent margin-bottom" >
                  <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                     <li class="page-item active"><a class="page-link" href="#">1</a></li>
                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <li class="page-item "><a class="page-link" href="#">4</a></li>
                     <li class="page-item"><a class="page-link" href="#">5</a></li>
                     <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-3 col-sm-12">
            <div class="aside_sec hidden-xs">
               <img src="{{ asset('images/side-business-listing.jpg') }}" alt=""/>
               <div class="img_content">
                  <h5>Did you ever had a business that you couldn't wait to tell it your friends?</h5>
                  <p>Here you can share it with the world!</p>
                  <a href="javascript:void(0)" class="learn-more">Learn More  <img src="{{ asset('images/search-btn-icon.png') }}"></a>  
               </div>
            </div>
            <div class="aside_sec">                    
               <img src="{{ asset('images/google_map.jpg') }}" alt=""/>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection