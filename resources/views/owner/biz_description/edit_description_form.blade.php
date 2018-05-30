@extends('layouts.owner')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Business Description </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('owner.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Business Description</li>
      </ol>
   </section>

    <div id="msgs">
           @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
           @endif
   </div>

   <!-- Main content -->
   <section class="content">
      <div class="box box-primary">
         <!-- form start -->
         <form id="edit-description-form" role="form" action="{{ route('owner.update_business_description', ['slug' => $slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Business Description</label>
                  <textarea name="description" rows="15" cols="50" class="form-control" required="required">@if(@sizeof($businessListing->description)){{ $businessListing->description }}@endif</textarea>
               </div>                              

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="description-submit-btn" type="submit" class="btn btn-primary">Submit</button>
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

CKEDITOR.replace( 'description', {
  extraPlugins: 'justify'
});

CKEDITOR.config.allowedContent = true;

$(document).ready(function()
{

   //Adding-Validations
  $('#edit-description-form').validate({
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

  $('#description-submit-btn').click(function()
  {
    if($('#edit-description-form').valid())
    {
      $('#description-submit-btn').prop('disabled', true);
      $('#edit-description-form').submit();
    }else{
      return false;
    }
  });   
});


</script>     

@endsection