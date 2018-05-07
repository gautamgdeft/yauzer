@extends('layouts.user')

@section('content')

<!-- Loader Html -->
<div class="loading hide">
   <p><span id="textt"></span>..Please wait..</p>
</div>
<style type="text/css">
   /*Loader Css Starts*/
   /* Absolute Center Spinner */
   .loading {
   position: fixed;
   z-index: 999;
   height: 2em;
   width: 2em;
   overflow: show;
   margin: auto;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   }
   .loading p{
   z-index: 999;
   width: 100%;
   color: #fff;
   z-index: 9999;
   position: fixed;
   left: 0;
   right: 0;
   margin: 0 auto;
   text-align: center;
   padding-top: 25px;
   }
   /* Transparent Overlay */
   .loading:before {
   content: '';
   display: block;
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-color: rgba(51,51,102,0.2);
   }
   /* :not(:required) hides these rules from IE9 and below */
   .loading:not(:required) {
   /* hide "loading..." text */
   color: transparent;
   text-shadow: none;
   background-color: transparent;
   border: 0;
   }
   .loading:not(:required):after {
   content: '';
   display: block;
   font-size: 10px;
   width: 1em;
   height: 1em;
   margin-top: -0.5em;
   -webkit-animation: spinner 1500ms infinite linear;
   -moz-animation: spinner 1500ms infinite linear;
   -ms-animation: spinner 1500ms infinite linear;
   -o-animation: spinner 1500ms infinite linear;
   animation: spinner 1500ms infinite linear;
   border-radius: 0.5em;
   /*-webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
   box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;*/
   -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, 
   rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, 
   rgba(255, 255, 255, 0.75) 0 1.5em 0 0, 
   rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, 
   rgba(255, 255, 255, 0.5) -1.5em 0 0 0, 
   rgba(255, 255, 255, 0.5) -1.1em -1.1em 0 0, 
   rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, 
   rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
   box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, 
   rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, 
   rgba(255, 255, 255, 0.75) 0 1.5em 0 0, 
   rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, 
   rgba(255, 255, 255, 0.75) -1.5em 0 0 0, 
   rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, 
   rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, 
   rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
   }
   }
   /* Animation */
   @-webkit-keyframes spinner {
   0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
   }
   100% {
   -webkit-transform: rotate(360deg);
   -moz-transform: rotate(360deg);
   -ms-transform: rotate(360deg);
   -o-transform: rotate(360deg);
   transform: rotate(360deg);
   }
   }
   @-moz-keyframes spinner {
   0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
   }
   100% {
   -webkit-transform: rotate(360deg);
   -moz-transform: rotate(360deg);
   -ms-transform: rotate(360deg);
   -o-transform: rotate(360deg);
   transform: rotate(360deg);
   }
   }
   @-o-keyframes spinner {
   0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
   }
   100% {
   -webkit-transform: rotate(360deg);
   -moz-transform: rotate(360deg);
   -ms-transform: rotate(360deg);
   -o-transform: rotate(360deg);
   transform: rotate(360deg);
   }
   }
   @keyframes spinner {
   0% {
   -webkit-transform: rotate(0deg);
   -moz-transform: rotate(0deg);
   -ms-transform: rotate(0deg);
   -o-transform: rotate(0deg);
   transform: rotate(0deg);
   }
   100% {
   -webkit-transform: rotate(360deg);
   -moz-transform: rotate(360deg);
   -ms-transform: rotate(360deg);
   -o-transform: rotate(360deg);
   transform: rotate(360deg);
   }
   }
   /*#map {background: transparent url(assets/spinn.gif) no-repeat center center;}*/
</style>


<div class="blog-form-wrapper create-listing list-new">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="blog-form-heading">
          <h2 id="yauzer_heading_text">Welcome, you’re about to Yauzer a business</h2>
        </div>
        <div class="blog-form-container padding-less" id="padding-less">

          <div id="msgs">
             @if(session('success'))
             <div class="alert alert-success">
              {{ session('success') }}
            </div>
            @endif

            @if(Session::has('success_msz_business'))
            <div class="custom-alert custom-alert-success">
              {{ Session::get('success_msz_business') }}
              <p>Do you want to Yauzer another business? <a class="yes_btn_yauzer" href="{{ route('user.yauzer_business') }}">Yes</a> <a class="no_btn_yauzer" href="{{ route('home.welcome') }}">No</a></p>
            </div>
            @endif

          </div>

          <form name="yauzer_business" id="yauzer_business" method="Post" action="{{ route('user.save_yauzer') }}">

            {{ csrf_field() }}
            
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">            

            {{-- User for checking business on another location --}}
            <input type="hidden" name="businesslatitude" id="businesslatitude">
            <input type="hidden" name="businesslongitude" id="businesslongitude">




            
            <div class="col-md-6 col-sm-6 {{ @sizeof($uri_segments)? 'hide' : '' }}" id="business_location">
              <div class="form-group location-box">  
              <label for="headline">Business Location</label>
              <input type="text" id="location" name="location" class="form-control form-input" placeholder="Type location to get Business from another Location">
              <button type="button" class="search-button-1" id="shuffleBusiness"><i class="fa fa-search"></i></button>
              </div>
            </div> 

{{--             <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Business Name<span> *</span></label>
              <select name="business_id" class="form-control form-input" id="business_select" required>
                 <option value="" disabled selected>Choose Business you want to yauzer</option>
                @if(sizeof($businesses))
                @foreach($businesses as $loopingBusiness)
                 <option value="{{ $loopingBusiness->id }}" @if($uri_segments[2] == $loopingBusiness->slug) selected="selected" @endif>{{ $loopingBusiness->name }}</option>
                @endforeach
                @endif
                 <option value="other">NEW BUSINESS</option>
              </select>  
              </div>
            </div> --}}             

            <div class="col-md-6 col-sm-6">
              <div class="form-group new-selectbox">
              <label for="headline">Business Name<span> *</span></label>
               <select name="business_id" class="form-control form-input selectpicker" id="business_select" required>
                 <option value="" disabled selected>Choose Business you want to yauzer</option>
                @if(sizeof($businesses))
                @foreach($businesses as $loopingBusiness)
                 <option value="{{ $loopingBusiness->id }}" @if($uri_segments[2] == $loopingBusiness->slug) selected="selected" @endif>{{ $loopingBusiness->name }}</option>
                @endforeach
                @endif
                 <option value="other">NEW BUSINESS</option>
              </select>
              </div>
            </div>            

            <div class="col-md-6 col-sm-6 hide" id="business_name">
              <div class="form-group">
              <label for="headline">Business Name<span> *</span></label>
              <input type="text" id="name" name="name" class="form-control form-input" placeholder="Enter Business Name" required>
              </div>
            </div>            

            <div class="col-md-6 col-sm-6 hide" id="category">
              <div class="form-group">
              <label for="headline">Business Category<span> *</span></label>
              <select name="business_category" class="form-control form-input" id="business_category" required>
                @if(sizeof($business_categories))
                 <option value="" disabled selected>Choose Business Category</option>
                @foreach($business_categories as $loopingCategory)
                 <option value="{{ $loopingCategory->id }}">{{ $loopingCategory->name }}</option>
                @endforeach
                @endif
              </select>  
              </div>
            </div>            

            <div class="col-md-6 col-sm-6 hide" id="subcategory">
              <div class="form-group">
              <label for="headline">Business Subcategory<span> *</span></label>
              <select name="business_subcategory[]" class="form-control form-input businessSubcategory" id="business_subcategory" multiple="true" required>
                
              </select>  
              </div>
            </div>

            <div class="col-md-6 col-sm-6 ">
              <div class="form-group">
              <label for="headline">Address<span> *</span></label>
              <input type="text" id="address" name="address" class="form-control form-input" placeholder="Enter Address" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->address : '' }}" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">City<span> *</span></label>
              <input type="text" id="city" name="city" class="form-control form-input" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->city : '' }}" placeholder="Enter City" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">State<span> *</span></label>
              <input type="text" id="state" name="state" class="form-control form-input" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->state : '' }}" placeholder="Enter State" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Zip Code<span> *</span></label>
              <input type="text" id="zipcode" name="zipcode" class="form-control form-input" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->zipcode : '' }}" placeholder="Enter Zip Code" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Phone Number</label>
              <input type="text" id="phone_number" name="phone_number" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->phone_number : '' }}" class="form-control form-input input-medium bfh-phone" data-country="US" data-number="{{ @sizeof($choosedBusiness)? $choosedBusiness->phone_number : '' }}" placeholder="Enter Phone Number" disabled>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Website</label>
              <input name="website" id="website" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->website : '' }}" type="text" class="form-control form-input" placeholder="Enter Website" disabled>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Email Address</label>
              <input name="email" id="email" type="text" value="{{ @sizeof($choosedBusiness)? $choosedBusiness->email : '' }}" class="form-control form-input" placeholder="Enter Email Address" disabled>
              </div>
            </div>

            <div class="col-md-12 col-sm-12">
              <div id="yauzer_div" class="form-group{{ $errors->has('yauzer') ? ' has-error' : '' }}">
              <label>What makes this business your favorite, give it a Yauz!<span> *</span></label>
              <textarea name="yauzer" id="yauzer" class="form-control" rows="8" {{ @sizeof($choosedBusiness) ? '' : 'disabled' }} required></textarea>
                
                @if ($errors->has('yauzer'))
                <span class="help-block">
                  <strong>{{ $errors->first('yauzer') }}</strong>
                </span>
                @endif

              </div>


            </div>            

            <div class="col-md-12 col-sm-12">
							<div id="yauzer_div" class="form-group">
              <label>Rating</label>
              <input id="input-21e" value="5" type="text" class="form-control rating" data-min=0 data-max=5 data-step=1 data-size="xs" name="rating" title="">
							</div>
            </div>

            <div class="blog-form-button-container">
              <button id="store_yauzer_btn" class="blog-form-submit" type="submit" {{ @sizeof($choosedBusiness) ? '' : 'disabled' }}> Submit</button>
              <button type="button" class="blog-form-cancel reset_yauzer_form">Cancel</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection