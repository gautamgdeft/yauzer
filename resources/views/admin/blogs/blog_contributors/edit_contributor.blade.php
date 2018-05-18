@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Blog Contributor </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Blog Contributor</li>
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
         <form id="edit-blog-contributor-form" role="form" action="{{ route('admin.update_blog_contributor',['slug' => $contributor->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="title">Name</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{ $contributor->title }}" required="required">

                  @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif

               </div>               
                                                                                                            
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
               <button id="edit-blog-contributor-submit-btn" type="submit" class="btn btn-primary">Update</button>
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
  $(document).ready(function(){
  //Adding-Validations-On-Business-Form
  $('#edit-blog-contributor-form').validate({
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

  $('#edit-blog-contributor-submit-btn').click(function()
  {
    if($('#edit-blog-contributor-form').valid())
    {
      $('#edit-blog-contributor-submit-btn').prop('disabled', true);
      $('#edit-blog-contributor-form').submit();
    }else{
      return false;
    }
  }); 


});    
 </script>
@endsection