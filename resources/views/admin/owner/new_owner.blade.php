@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New Owner </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New Owner</li>
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
         <form role="form" action="{{ route('admin.store_owner') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="required">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>               

               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required="required">

      			      @if ($errors->has('email'))
      			        <span class="help-block">
      			            <strong>{{ $errors->first('email') }}</strong>
      			        </span>
      			      @endif

               </div>

               <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" value="" required="required">

                  @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                  <label for="country">Country</label>
                  <select class="form-control" id="country" name="country" value="{{ old('country') }}" required="required">
                  <option value="">Choose Country</option>  
                  @if(!is_null($country))
                    @foreach($country as $loopingCountries)  
                    <option value="{{ $loopingCountries }}">{{ $loopingCountries }}</option>
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
                  <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required="required">

                  @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                  <label for="address">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required="required">

                  @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                  <label for="address">State</label>
                  <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required="required">

                  @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                  <label for="zipcode">Zipcode</label>
                  <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ old('zipcode') }}" required="required">

                  @if ($errors->has('zipcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required="required">

                  @if ($errors->has('phone_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                  @endif

               </div>                                                                                                             

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Profile Image</label>
                  <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);" >

                  @if ($errors->has('avatar'))
      			        <span class="help-block">
      			            <strong>{{ $errors->first('avatar') }}</strong>
      			        </span>
		              @endif

                  <img id="image_src" class="img-circle" src="/uploads/avatars/default.png" style="height: 45px; width: 45px;">
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
                                    <input type="text" class="form-control" name="credit_card_owner_name" id="owner">
                                </div>
                                <div class="form-group CVV">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" id="cvv" name="cvv">
                                </div>
                                <div class="form-group" id="card-number-field">
                                    <label for="credit_card_number">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber" name="credit_card_number">
                                </div>
                                <div class="form-group" id="expiration-date">
                                    <label>Expiration Date</label>
                                    <select name="credit_exp_month">
                                        <option value="">Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February </option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    <select name="credit_exp_year">
                                        <option value="">Year</option>
                                        <option value="16"> 2016</option>
                                        <option value="17"> 2017</option>
                                        <option value="18"> 2018</option>
                                        <option value="19"> 2019</option>
                                        <option value="20"> 2020</option>
                                        <option value="21"> 2021</option>
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
               <button type="submit" class="btn btn-primary">Submit</button>
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