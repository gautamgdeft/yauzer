@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Customer </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Customer</li>
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
         <form role="form" action="{{ route('admin.update_customer',['slug' => $user->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">

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
                  <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">

                  @if ($errors->has('country'))
                    <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">

                  @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                  <label for="address">City</label>
                  <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">

                  @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                  @endif

               </div>


               <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                  <label for="address">State</label>
                  <input type="text" class="form-control" id="state" name="state" value="{{ $user->state }}">

                  @if ($errors->has('state'))
                    <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                  <label for="zipcode">Zipcode</label>
                  <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{ $user->zipcode }}">

                  @if ($errors->has('zipcode'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zipcode') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">

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

                  <img id="image_src" class="img-circle" src="/uploads/avatars/{{ $user->avatar }}" style="height: 45px; width: 45px;">
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
               <a href="{{ URL::previous() }}" class="btn btn-primary">Go Back</a>
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