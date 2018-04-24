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
   <form id="edit-footer-menu-form" role="form" action="{{ route('admin.update_footer_menu',['slug' => $footerMenu->slug]) }}" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="box-body">

     <div class="form-group{{ $errors->has('page_id') ? ' has-error' : '' }}">
        <label for="page_id">Page</label>
        <select class="form-control" id="menu_name" name="page_id" required="required">
          <option value="" disabled selected>Choose Page Name</option>
          @if(@sizeof($pages))
           @foreach($pages as $loopingPage)
           <option value="{{ $loopingPage->id }}" @if($footerMenu->page_id == $loopingPage->id) selected="selected" @endif>{{ $loopingPage->name }}</option>
           @endforeach
          @endif
        </select>

        @if ($errors->has('page_id'))
          <span class="help-block">
              <strong>{{ $errors->first('page_id') }}</strong>
          </span>
        @endif

     </div>  

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
      <input type="text" class="form-control" id="url" name="url" value="{{ $footerMenu->url }}" required="required" readonly="readonly">

      @if ($errors->has('url'))
      <span class="help-block">
        <strong>{{ $errors->first('url') }}</strong>
      </span>
      @endif

    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
   <button id="footer-submit-btn" type="submit" class="btn btn-primary">Update</button>
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
       //Adding-Validations
  $('#edit-footer-menu-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {

      "name": {
          maxlength: 50,
          alphanumeric: true, 
      },      
      valueToBeTested: {
          required: true,
      }

    },

  });


  $('#menu_name').on('change', function()
  {
     if($(this).val() != '')
     {
        $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
         url: "/admin/get-menu-links",
         type: "post",
         dataType: "JSON",
         data: { 'id': $(this).val() },
         success: function(response)
         { 
            //Firstly-Empty-the-previous values of select box
            $('#url').html(' ');

            if(response.status == 'success') 
            {
              $('#url').val(response.menu_url);   
              $('#name').val(response.page_name);   
            }else{
               $('#url').val("No url found. Try again with another menu"); 
            }
         },
         error: function( response ) 
         {
           if ( response.status === 422 ) 
           {
             $(this).html('Try Again');
             $('#msgs').html("<div class='alert alert-danger'>"+response.msg+"</div>");
           }
         }

       });

     }else{

      //If Business category is not present
      $('#msgs').html("<div class='alert alert-danger'>Some error occured please choose menu again.</div>");
     }
  });  

  $('#footer-submit-btn').click(function()
  {
    if($('#edit-footer-menu-form').valid())
    {
      $('#footer-submit-btn').prop('disabled', true);
      $('#edit-footer-menu-form').submit();
    }else{
      return false;
    }
  });

    $.validator.addMethod("alphanumeric", function (value, element) {
    return this.optional(element) || /^[a-z0-9s ]+$/i.test(value);
    }, "Only letters, numbers are allowed.");  
  });
</script>     

@endsection