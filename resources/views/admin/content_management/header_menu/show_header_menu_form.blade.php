@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New Header Menu </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New Header Menu</li>
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
         <form id="header-form" role="form" action="{{ route('admin.store_header_menu') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">Menu Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required="required">

                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif

               </div>
                            
               <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                  <label for="url">Menu Url</label>
                  <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required="required">

                  @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                  @endif

               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="header-submit-btn" type="submit" class="btn btn-primary">Submit</button>
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
  $('#header-form').validate({
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

  $('#header-submit-btn').click(function()
  {
    if($('#header-form').valid())
    {
      $('#header-submit-btn').prop('disabled', true);
      $('#header-form').submit();
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