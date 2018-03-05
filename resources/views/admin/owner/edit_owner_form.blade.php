@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Edit Owner </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Edit Owner</li>
 </ol>
</section>

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
   <!-- form start -->
   <form role="form" action="{{ route('admin.update_owner',['slug' => $user->slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="box-body">
     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required="required">

      @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif

    </div>               

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>

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
      <option value="{{ $loopingCountries }}" @if($loopingCountries == $user->country) selected="selected" @endif >{{ $loopingCountries }}</option>
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
    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" required="required">

    @if ($errors->has('address'))
    <span class="help-block">
      <strong>{{ $errors->first('address') }}</strong>
    </span>
    @endif

  </div>


  <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    <label for="address">City</label>
    <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" required="required">

    @if ($errors->has('city'))
    <span class="help-block">
      <strong>{{ $errors->first('city') }}</strong>
    </span>
    @endif

  </div>


  <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    <label for="address">State</label>
    <input type="text" class="form-control" id="state" name="state" value="{{ $user->state }}" required="required">

    @if ($errors->has('state'))
    <span class="help-block">
      <strong>{{ $errors->first('state') }}</strong>
    </span>
    @endif

  </div>

  <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
    <label for="zipcode">Zipcode</label>
    <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $user->zipcode }}" required="required">

    @if ($errors->has('zipcode'))
    <span class="help-block">
      <strong>{{ $errors->first('zipcode') }}</strong>
    </span>
    @endif

  </div>

  <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
    <label for="phone_number">Phone Number</label>
    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}" required="required">

    @if ($errors->has('phone_number'))
    <span class="help-block">
      <strong>{{ $errors->first('phone_number') }}</strong>
    </span>
    @endif

  </div>                                                                                                             

  <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
    <label for="avatar">Profile Image</label>
    <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

    @if ($errors->has('avatar'))
    <span class="help-block">
     <strong>{{ $errors->first('avatar') }}</strong>
   </span>
   @endif

   <img id="image_src" class="img-circle" src="/uploads/avatars/{{ $user->avatar }}" style="height: 45px; width: 45px;">
 </div>
</div>
<!-- /.box-body -->

            <div class="container-fluid">
                    <div class="creditCardForm">
                      <div class="heading">
                        <h1>Credit Card Details</h1>
                      </div>
                        <div class="payment">
                                <div class="form-group owner">
                                    <label for="credit_card_owner_name">Customer Name</label>
                                    <input type="text" class="form-control" name="credit_card_owner_name" id="owner" value="{{ $user->creditcards->credit_card_owner_name  }}">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" value="{{ $user->creditcards->cvv  }}">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="credit_card_number">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber" name="credit_card_number" value="{{ $user->creditcards->credit_card_number  }}">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select name="credit_exp_month">
                                        <option value="">Month</option>
                                        <option value="01" @if($user->creditcards->credit_exp_month == "01")selected="selected"@endif>January</option>
                                        <option value="02" @if($user->creditcards->credit_exp_month == "02")selected="selected"@endif>February </option>
                                        <option value="03" @if($user->creditcards->credit_exp_month == "03")selected="selected"@endif>March</option>
                                        <option value="04" @if($user->creditcards->credit_exp_month == "04")selected="selected"@endif>April</option>
                                        <option value="05" @if($user->creditcards->credit_exp_month == "05")selected="selected"@endif>May</option>
                                        <option value="06" @if($user->creditcards->credit_exp_month == "06")selected="selected"@endif>June</option>
                                        <option value="07" @if($user->creditcards->credit_exp_month == "07")selected="selected"@endif>July</option>
                                        <option value="08" @if($user->creditcards->credit_exp_month == "08")selected="selected"@endif>August</option>
                                        <option value="09" @if($user->creditcards->credit_exp_month == "09")selected="selected"@endif>September</option>
                                        <option value="10" @if($user->creditcards->credit_exp_month == "10")selected="selected"@endif>October</option>
                                        <option value="11" @if($user->creditcards->credit_exp_month == "11")selected="selected"@endif>November</option>
                                        <option value="12" @if($user->creditcards->credit_exp_month == "12")selected="selected"@endif>December</option>
                                    </select>
                                    <select name="credit_exp_year">
                                        <option value="">Year</option>
                                        <option value="18" @if($user->creditcards->credit_exp_year == "18")selected="selected"@endif> 2018</option>
                                        <option value="19" @if($user->creditcards->credit_exp_year == "19")selected="selected"@endif> 2019</option>
                                        <option value="20" @if($user->creditcards->credit_exp_year == "20")selected="selected"@endif> 2020</option>
                                        <option value="21" @if($user->creditcards->credit_exp_year == "21")selected="selected"@endif> 2021</option>
                                        <option value="22" @if($user->creditcards->credit_exp_year == "22")selected="selected"@endif> 2022</option>
                                        <option value="23" @if($user->creditcards->credit_exp_year == "23")selected="selected"@endif> 2023</option>
                                        <option value="24" @if($user->creditcards->credit_exp_year == "24")selected="selected"@endif> 2024</option>
                                    </select>
                                </div>
                                <div class="form-group" id="credit_cards">
                                  <img src="{{URL::asset('img/credit-card/visa.jpg')}}" id="visa">
                                  <img src="{{URL::asset('img/credit-card/mastercard.jpg')}}" id="mastercard">
                                  <img src="{{URL::asset('img/credit-card/amex.jpg')}}" id="amex">
                                </div>
                        </div>
                    </div>
                 </div>

<div class="box-footer">
 <button type="submit" class="btn btn-primary">Update</button>
 <a href="{{ URL::previous() }}" class="btn btn-warning">Go Back</a>
</div>
</form>
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts')
<script src="{{ asset('js/admin/credit_card/jquery.payform.min.js') }}"></script>
<script src="{{ asset('js/admin/credit_card/script.js') }}"></script>
<script type="text/javascript">

  $(document).ready(function()
  {
    $("#avatar").change(function () {
      readURL(this);
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

</script>     

@endsection