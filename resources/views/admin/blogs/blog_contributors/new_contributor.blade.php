@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New Blog Contributor </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New Blog Contributor</li>
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
         <form id="blog-contributor-form" role="form" action="{{ route('admin.store_blog_contributor') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="title">Name</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required="required">

                  @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif

               </div>                             

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="contributor-submit-btn" type="submit" class="btn btn-primary">Submit</button>
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
  
  $(document).ready(function(){
  //Adding-Validations-On-Business-Form
  $('#blog-contributor-form').validate({
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

  $('#contributor-submit-btn').click(function()
  {
    if($('#blog-contributor-form').valid())
    {
      $('#contributor-submit-btn').prop('disabled', true);
      $('#blog-contributor-form').submit();
    }else{
      return false;
    }
  }); 


});
 </script>
@endsection