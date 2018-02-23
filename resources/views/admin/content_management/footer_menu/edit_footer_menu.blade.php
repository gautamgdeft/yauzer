@extends('layouts.admin')
@section('content')


<aside class="right-side">
 <!-- Content Header (Page header) -->
 <section class="content-header">
  <h1> Edit Footer Menu </h1>
  <ol class="breadcrumb">
   <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li class="active">Edit Footer Menu</li>
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
   <form role="form" action="{{ route('admin.update_footer_menu',['slug' => $footerMenu->slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="box-body">
     <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
      <label for="name">Menu Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ $footerMenu->name }}" required="required">

      @if ($errors->has('name'))
      <span class="help-block">
        <strong>{{ $errors->first('name') }}</strong>
      </span>
      @endif

    </div>               
    

    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
      <label for="url">Menu Url</label>
      <input type="text" class="form-control" id="url" name="url" value="{{ $footerMenu->url }}" required="required">

      @if ($errors->has('url'))
      <span class="help-block">
        <strong>{{ $errors->first('url') }}</strong>
      </span>
      @endif

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