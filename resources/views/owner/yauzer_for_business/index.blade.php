@extends('layouts.user')

@section('content')

<div class="blog-form-wrapper create-listing list-new">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="blog-form-heading">
          <h2>Congratulations, Claim or Add business</h2>
        </div>
        <div class="blog-form-container padding-less" id="padding-less">

          <div id="msgs">
           @if(session('success'))
           <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
          </div>

          <form name="yauzer_for_business" id="yauzer_for_business" method="Post" action="{{ route('owner.claim_business') }}"> 

            {{ csrf_field() }}
            
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="checkPost" id="checkPost">
            
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Business Name<span> *</span></label>
              <select name="business_id" class="form-control form-input" id="business_select" required>
                 <option value="" disabled selected>Claim or Add Your Business</option>
                @if(sizeof($businesses))
                @foreach($businesses as $loopingBusiness)
                 <option value="{{ $loopingBusiness->id }}">{{ $loopingBusiness->name }}</option>
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
              <input type="text" id="address" name="address" class="form-control form-input" placeholder="Enter Address" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">City<span> *</span></label>
              <input type="text" id="city" name="city" class="form-control form-input" placeholder="Enter City" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">State<span> *</span></label>
              <input type="text" id="state" name="state" class="form-control form-input" placeholder="Enter State" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Zip Code<span> *</span></label>
              <input type="text" id="zipcode" name="zipcode" class="form-control form-input" placeholder="Enter Zip Code" disabled required>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Phone Number</label>
              <input type="text" id="phone_number" name="phone_number" class="form-control form-input" placeholder="Enter Phone Number" disabled>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Website</label>
              <input name="website" id="website" type="text" class="form-control form-input" placeholder="Enter Website" disabled>
              </div>
            </div>

            <div class="col-md-6 col-sm-6">
              <div class="form-group">
              <label for="headline">Email Address</label>
              <input name="email" id="email" type="text" class="form-control form-input" placeholder="Enter Email Address" disabled>
              </div>
            </div>

            <div class="blog-form-button-container">
              <button id="claim_business_btn" name="clain_business" value="claimed" class="blog-form-submit" type="submit" disabled> Claim Business</button>              
              <button id="submit_business" class="blog-form-submit hide" type="submit"> Add Business</button>
              <button type="button" class="blog-form-cancel reset_form">Cancel</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('custom_scripts')
  <script src="{{ asset('js/owner/owner.js') }}"></script>
@endsection