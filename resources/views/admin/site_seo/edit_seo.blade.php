@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Site Seo </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Site Seo</li>
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
         <form id="blog-form" role="form" action="{{ route('admin.update_seo', ['slug' => $siteseo->slug]) }}" enctype="multipart/form-data" method="POST">
         	{{ csrf_field() }}
            <div class="box-body">                
                            
               <div class="form-group{{ $errors->has('metatitle') ? ' has-error' : '' }}">
                  <label for="metatitle">Meta-Title</label>
                  <input type="text" class="form-control" id="metatitle" name="metatitle" value="{{ $siteseo->metatitle }}" required="required">

                  @if ($errors->has('metatitle'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metatitle') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metakeywords') ? ' has-error' : '' }}">
                  <label for="metakeywords">Meta-Keywords</label>
                  <textarea class="form-control" id="metakeywords" name="metakeywords" required="required">{{ $siteseo->metakeywords }}</textarea>

                  @if ($errors->has('metakeywords'))
                    <span class="help-block">
                        <strong>{{ $errors->first('metakeywords') }}</strong>
                    </span>
                  @endif

               </div>                

               <div class="form-group{{ $errors->has('metadescription') ? ' has-error' : '' }}">
                  <label for="metadescription">Meta-Description</label>
                  <textarea class="form-control" id="metadescription" name="metadescription" required="required">{{ $siteseo->metadescription }}</textarea>

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

@endsection