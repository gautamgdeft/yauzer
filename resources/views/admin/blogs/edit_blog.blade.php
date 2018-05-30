@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Blog </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Blog</li>
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
         <form id="blog-form" role="form" action="{{ route('admin.update_blog', ['slug' => $blog->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('blog_category_id') ? ' has-error' : '' }}">
                  <label for="blog_category_id">Blog Category</label>
                  
                  <select class="form-control" name="blog_category_id" id="blog_category_id" required> 
                    <option value="">Select Blog Category</option>
                    @if(sizeof($blogcategories))
                    @foreach($blogcategories as $loopingcategories)
                     <option value="{{ $loopingcategories->id }}" @if($loopingcategories->id == $blog->blog_category_id) selected="selected" @endif>{{ $loopingcategories->name }}</option>
                    @endforeach
                    @endif
                  </select> 

                  @if ($errors->has('blog_category_id')) 
                    <span class="help-block">
                        <strong>{{ $errors->first('blog_category_id') }}</strong>
                    </span>
                  @endif

               </div>                


               <div class="form-group{{ $errors->has('blog_contributor_id') ? ' has-error' : '' }}">
                  <label for="blog_contributor_id">Blog Contributor</label>
                  
                  <select class="form-control" name="blog_contributor_id" id="blog_contributor_id" required> 
                    <option value="">Select Blog Category</option>
                    @if(sizeof($blogcontributors))
                    @foreach($blogcontributors as $loopingcontributors)
                     <option value="{{ $loopingcontributors->id }}" @if($loopingcontributors->id == $blog->blog_contributor_id) selected="selected" @endif>{{ $loopingcontributors->title }}</option>
                    @endforeach
                    @endif
                  </select> 

                  @if ($errors->has('blog_contributor_id')) 
                    <span class="help-block">
                        <strong>{{ $errors->first('blog_contributor_id') }}</strong>
                    </span>
                  @endif

               </div>                             

               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" required="required">

                  @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif

               </div>      

               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description-ckeditor" required="required">{{ $blog->description }}</textarea>

                  @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif

               </div>               

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Image</label>
                  <input type="file" name="avatar" id="avatar" class="form-control" onchange="ValidateSingleInput(this);"> 

                  @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                  @endif

                <img id="image_src" class="img-circle" src="/uploads/blogavatars/{{ $blog->avatar }}" style="height: 45px; width: 45px;">

               </div>

               <div class="form-group{{ $errors->has('metatitle') ? ' has-error' : '' }}">
                  <label for="metatitle">Meta-Title</label>
                  <input type="text" class="form-control" id="metatitle" name="metatitle" value="{{ $blog->metatitle }}" required="required">

                  @if ($errors->has('metatitle'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metatitle') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metakeywords') ? ' has-error' : '' }}">
                  <label for="metakeywords">Meta-Keywords</label>
                  <textarea class="form-control" id="metakeywords" name="metakeywords" required="required">{{ $blog->metakeywords }}</textarea>

                  @if ($errors->has('metakeywords'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metakeywords') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metadescription') ? ' has-error' : '' }}">
                  <label for="metadescription">Meta-Description</label>
                  <textarea class="form-control" id="metadescription" name="metadescription" required="required">{{ $blog->metadescription }}</textarea>

                  @if ($errors->has('metadescription'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metadescription') }}</strong>
                    </span>
                  @endif

               </div>                 

               <div class="form-group{{ $errors->has('created_at') ? ' has-error' : '' }}">
                  <label for="created_at">Date Published</label>
                  <input type="text" class="form-control created_at" id="created_at" name="created_at" value="{{ Carbon\Carbon::parse($blog->created_at)->format('m/d/Y') }}" required="required">

                  @if ($errors->has('created_at'))
                    <span class="help-block">
                        <strong>{{ $errors->first('created_at') }}</strong>
                    </span>
                  @endif

               </div>                

            </div>            

            <!-- /.box-body -->
            <div class="box-footer">
               <button id="blog-submit-btn" type="submit" class="btn btn-primary">Submit</button>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

 <script type="text/javascript">
  
  CKEDITOR.replace( 'description-ckeditor', {
    extraPlugins: 'justify'
  });
  
  $(document).ready(function(){
  //Adding-Validations-On-Business-Form
  $('#blog-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      valueToBeTested: {
          required: true,
      }

    },  
  });   

  $('#blog-submit-btn').click(function()
  {
    if($('#blog-form').valid())
    {
      $('#blog-submit-btn').prop('disabled', true);
      $('#blog-form').submit();
    }else{
      return false;
    }
  }); 

  $("#avatar").change(function () 
  {
  readURL(this);
  });

$('.created_at').datepicker({
    format: 'mm/dd/yyyy',
    autoclose: true,
    todayHighlight: true    
});

}); //EndReadyFunction


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