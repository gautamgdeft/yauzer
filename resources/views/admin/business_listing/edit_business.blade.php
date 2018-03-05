@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Business </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Business</li>
      </ol>
   </section>

                 @if(session('success'))
                  <div class="alert alert-success">
                  {{ session('success') }}
                  </div>
                 @endif

   <!-- Main content -->
   <section class="content">
      
     

      <div class="box">

         <div class="custom-tabing"> 
         <ul class="nav nav-tabs responsive" id="myTab">
          <li class="active"><a href="#business_detail">Business Detail</a></li>
          <li><a href="#business_hours">Business Hours</a></li>
        </ul>

        <div class="tab-content responsive">
          <div class="tab-pane active" id="business_detail">
             <!-- form start -->
             <form role="form" action="{{ route('admin.update_business',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">

                   <!--Hidden Fields-->
                   <input type="hidden" name="latitude" id="latitude" value="{{ $businessListing->latitude }}">
                   <input type="hidden" name="longitude" id="longitude" value="{{ $businessListing->longitude }}">

                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $businessListing->name }}" required="required">

                      @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif

                   </div>               

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="email">Email Address</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{ $businessListing->email }}" disabled>

                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                      <label for="country">Country</label>
                      <select class="form-control" id="country" name="country" value="{{ old('country') }}" required="required">
                      <option value="">Choose Country</option>  
                      @if(!is_null($country))
                        @foreach($country as $loopingCountries)  
                        <option value="{{ $loopingCountries }}" @if($loopingCountries == $businessListing->country) selected="selected" @endif >{{ $loopingCountries }}</option>
                        @endforeach
                      @endif
                      </select>  

                      @if ($errors->has('country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                      @endif

                   </div> 

                   <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" value="{{ $businessListing->address }}" required="required">

                      @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                      <label for="address">City</label>
                      <input type="text" class="form-control" id="city" name="city" value="{{ $businessListing->city }}" required="required">

                      @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                      @endif

                   </div>


                   <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                      <label for="address">State</label>
                      <input type="text" class="form-control" id="state" name="state" value="{{ $businessListing->state }}" required="required">

                      @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                      <label for="zipcode">Zipcode</label>
                      <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $businessListing->zipcode }}" required="required">

                      @if ($errors->has('zipcode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('zipcode') }}</strong>
                        </span>
                      @endif

                   </div>

                   <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                      <label for="phone_number">Phone Number</label>
                      <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $businessListing->phone_number }}" required="required">

                      @if ($errors->has('phone_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone_number') }}</strong>
                        </span>
                      @endif

                   </div>                

                   <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                      <label for="website">Website</label>
                      <input type="text" class="form-control" id="website" name="website" value="{{ $businessListing->website }}" required="required">

                      @if ($errors->has('website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                      @endif

                   </div>                                                                                                             

                   <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                      <label for="avatar">Business Main Image</label>
                      <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

                      @if ($errors->has('avatar'))
                        <span class="help-block">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                      @endif

                      <img id="image_src" class="img-circle" src="/uploads/businessAvatars/{{ $businessListing->avatar }}" style="height: 45px; width: 45px;">
                   </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button type="submit" class="btn btn-primary">Update</button>
                   <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
                </div>
             </form>            
          </div>
          <div class="tab-pane" id="business_hours">
             <!-- form start -->
             @if(empty ( $businessHours->id ))
               @include('admin/business_listing/partials/business_hours/show_business_hours')         
             @else
               @include('admin/business_listing/partials/business_hours/updated_business_hours')
             @endif

          </div>
        </div>
      </div>

      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts')
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>

<script type="text/javascript">

$(function() { 
  
  $(".timepicker1").timepicker({
      showInputs: false
  });

});

$(document).ready(function()
{
  $("#avatar").change(function () {
  readURL(this);
   });  

  $('.business_checkbox').change(function() {
    
      if(this.checked) {
       $(this).closest('.test-sam').next('.text-right').removeClass('hide');
       $(this).closest('.test-sam').find("input[type='hidden']").val(1);
      }else{
       $(this).closest('.test-sam').next('.text-right').addClass('hide');
       $(this).closest('.test-sam').find("input[type='hidden']").val(0);
      }
      
  });   
});

/*---- Start Function For Checking Image Extension For Valid Image Selection ---*/

var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];

function ValidateSingleInput(oInput) {
    
    if (oInput.type == "file") {
      var sFileName = oInput.value;

      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) 
        {
          var sCurExtension = _validFileExtensions[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) 
          {
            blnValid = true;
            break;
          }
        }

        if (!blnValid) {

          alert('Sorry ! Allowed image extensions are .JPG, .JPEG, .GIF, .PNG');

          // swal("Sorry !", "Allowed image extensions are .JPG, .JPEG, .GIF, .PNG")
          oInput.value = "";
          return false;
        }
      }
    }
return true;
}

/*---- End Function For Checking Image Extension For Valid Image Selection ---*/ 

// Start Image Preview

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src').css('display', 'block');
        $('#image_src').attr('src', e.target.result);

        $('#avatar').removeClass('validate_error');
        $("#avatar").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//  End Image Preview 
  
  $( 'ul.nav.nav-tabs  a' ).click( function ( e ) {
    e.preventDefault();
    $( this ).tab( 'show' );
  } );  

  (function($) {
      fakewaffle.responsiveTabs(['xs', 'sm']);
  })(jQuery);
</script>
@endsection