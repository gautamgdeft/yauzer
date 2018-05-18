@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Add New Blog </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Add New Blog</li>
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
         <form id="blog-form" role="form" action="{{ route('admin.store_blog') }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">
               <div class="form-group{{ $errors->has('blog_category_id') ? ' has-error' : '' }}">
                  <label for="blog_category_id">Blog Category</label>
                  
                  <select class="form-control" name="blog_category_id" id="blog_category_id" required> 
                    <option value="">Select Blog Category</option>
                    @if(sizeof($blogcategories))
                    @foreach($blogcategories as $loopingcategories)
                     <option value="{{ $loopingcategories->id }}">{{ $loopingcategories->name }}</option>
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
                    <option value="">Select Blog Contributor</option>
                    @if(sizeof($blogcontributors))
                    @foreach($blogcontributors as $loopingcontributors)
                     <option value="{{ $loopingcontributors->id }}">{{ $loopingcontributors->title }}</option>
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
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required="required">

                  @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                  @endif

               </div>      

               <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description-ckeditor" required="required">{{ old('description') }}</textarea>

                  @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif

               </div>               

               <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                  <label for="avatar">Image</label>
                  <input type="file" name="avatar" id="avatar" class="form-control" required="required"> 

                  @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                  @endif

               </div>

               <div class="form-group{{ $errors->has('metatitle') ? ' has-error' : '' }}">
                  <label for="metatitle">Meta-Title</label>
                  <input type="text" class="form-control" id="metatitle" name="metatitle" value="{{ old('metatitle') }}" required="required">

                  @if ($errors->has('metatitle'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metatitle') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metakeywords') ? ' has-error' : '' }}">
                  <label for="metakeywords">Meta-Keywords</label>
                  <textarea class="form-control" id="metakeywords" name="metakeywords" required="required">{{ old('metakeywords') }}</textarea>

                  @if ($errors->has('metakeywords'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metakeywords') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metadescription') ? ' has-error' : '' }}">
                  <label for="metadescription">Meta-Description</label>
                  <textarea class="form-control" id="metadescription" name="metadescription" required="required">{{ old('metadescription') }}</textarea>

                  @if ($errors->has('metadescription'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metadescription') }}</strong>
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

 <script type="text/javascript">
  
  CKEDITOR.replace( 'description-ckeditor' );

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


});
 </script>
@endsection