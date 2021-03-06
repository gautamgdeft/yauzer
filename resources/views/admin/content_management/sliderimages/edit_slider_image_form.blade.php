@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Slider Image </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Slider Image</li>
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
         <form role="form" action="{{ route('admin.update_slider_image',['slug' => $sliderImage->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Slider Image</label>
                  <input type="file" id="avatar" name="avatar" class="form-control" onchange="ValidateSingleInput(this);">

                  @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                  @endif

                  <img id="image_src" class="" src="/uploads/sliderAvatars/{{ $sliderImage->avatar }}" style="height: 45px; width: 150px;">
               </div>  

               <div class="form-group{{ $errors->has('h2_description') ? ' has-error' : '' }}">
                  <label for="h2_description">H2 Description</label>
                  <input type="text" class="form-control" id="h2_description" name="h2_description" value="{{ $sliderImage->h2_description }}" required="required">

                  @if ($errors->has('h2_description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('h2_description') }}</strong>
                    </span>
                  @endif

               </div>                          

               <div class="form-group{{ $errors->has('h3_description') ? ' has-error' : '' }}">
                  <label for="h3_description">H3 Description</label>
                  <input type="text" class="form-control" id="h3_description" name="h3_description" value="{{ $sliderImage->h3_description }}" required="required">

                  @if ($errors->has('h3_description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('h3_description') }}</strong>
                    </span>
                  @endif

               </div>                 


               <div class="form-group{{ $errors->has('image_alt_text') ? ' has-error' : '' }}">
                  <label for="image_alt_text">Image Alt Text</label>
                  <input type="text" class="form-control" id="image_alt_text" name="image_alt_text" value="{{ $sliderImage->image_alt_text }}" required="required">

                  @if ($errors->has('image_alt_text'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image_alt_text') }}</strong>
                    </span>
                  @endif

               </div>
                                                                                                          
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
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