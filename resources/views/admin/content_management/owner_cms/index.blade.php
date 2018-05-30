@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Owner CMS
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Owner CMS</li>
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
      <div class="row">
         <div class="col-md-6">
            <div class="box box-danger">
               <div class="box-header">
                  <h3 class="box-title">Owner Heading Section</h3>
               </div>
               <form id="home_cms" role="form" action="{{ route('admin.update_owner_heading_section') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}              
                  <div class="box-body">
                    <div class="form-group">
                        <label>Heading Image:</label>
                        <input type="file" name="default_bg_image" class="form-control" id="result_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="image_result" src="/uploads/siteCMSAvatars/{{ $ownerHeadercms->default_bg_image }}" style="height: 35px; width: 511px;">                                            
                     </div>                    
                     <div class="form-group">
                        <label>Heading Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor">{{ $ownerHeadercms->description_ckeditor }}</textarea>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button id="home-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>

            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Basic Listing Free Section</h3>
               </div>
               <form id="result_cms" role="form" action="{{ route('admin.update_owner_basic_listing') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Basic Listing Heading:</label>
                        <input type="text" name="first_section" class="form-control" value="{{ $ownerBasicListingcms->first_section }}">
                     </div>
                     <div class="form-group">
                        <label>Basic Listing Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor1">{{ $ownerBasicListingcms->description_ckeditor }}</textarea>
                        </div>
                     </div>                                         
                  </div>
                  <div class="box-footer">
                     <button id="result-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>            

            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Market it! Get more Yauzers Header Section</h3>
               </div>
               <form id="result_cms" role="form" action="{{ route('admin.update_market_section') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                    <div class="form-group">
                        <label>Header Image:</label>
                        <input type="file" name="default_bg_image" class="form-control" id="market_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="market_result" src="/uploads/siteCMSAvatars/{{ $ownerMarketITcms->default_bg_image }}" style="height: 35px; width: 431px;">                                            
                     </div>                      
                     <div class="form-group">
                        <label>Header Description:</label>
                        <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor-market">{{ $ownerMarketITcms->description_ckeditor }}</textarea>
                     </div>                                        
                  </div>
                  <div class="box-footer">
                     <button id="result-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>            
         </div>
         <!-- /.col (left) -->
         <div class="col-md-6">
            <div class="box box-primary">
               <div class="box-header">
                  <h3 class="box-title">Pricing Structure</h3>
               </div>
               <form id="business_cms" role="form" action="{{ route('admin.update_pricing_structure') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                
                  <div class="box-body">
                     <div class="form-group">
                        <label>Default Background Image</label>
                        <input type="file" name="default_bg_image" class="form-control" id="default_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="image_src" src="/uploads/siteCMSAvatars/{{ $ownerPricingStructurecms->default_bg_image }}" style="height: 34px; width: 225px;">
                     </div>                     
                     <div class="form-group">
                        <label>Picture Coming Soon</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="first-section-ckeditor">{{ $ownerPricingStructurecms->description_ckeditor }}</textarea>
                        </div>
                     </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                     <button id="business-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>
            <!-- /.box -->
            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Premium Listing Section</h3>
               </div>
               <form id="login_cms" role="form" action="{{ route('admin.update_owner_premium_features') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Premium Listing Heading:</label>
                        <input type="text" name="first_section" class="form-control" value="{{ $ownerPremiumListingcms->first_section }}">
                     </div>
                     <div class="form-group">
                        <label>Premium Listing Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor2">{{ $ownerPremiumListingcms->description_ckeditor }}</textarea>
                        </div>
                     </div>                                         
                  </div>
                  <div class="box-footer">
                     <button id="login-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>

            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Market it! Get more Yauzers Email Templates Section</h3>
               </div>
               <form id="result_cms" role="form" action="{{ route('admin.update_market_section') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Basic Share Email Template Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="first_section" id="description-ckeditor-market1">{{ $ownerMarketITcms->first_section }}</textarea>
                        </div>
                     </div>                      
                     <div class="form-group">
                        <label>Basic Social Share Template Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="second_section" id="description-ckeditor-market2">{{ $ownerMarketITcms->second_section }}</textarea>
                        </div>
                     </div>                                          
                  </div>
                  <div class="box-footer">
                     <button id="result-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>              
         </div>
         <!-- /.col (right) -->
      </div>
      <!-- /.row -->                    
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection
@section('custom_scripts')
<script type="text/javascript">
      
      CKEDITOR.replace( 'description-ckeditor', {
        extraPlugins: 'justify',
        allowedContent: true
      });
      CKEDITOR.replace( 'description-ckeditor1', {
        extraPlugins: 'justify',
        allowedContent: true
      });
      CKEDITOR.replace( 'first-section-ckeditor', {
        extraPlugins: 'justify',
        allowedContent: true
      });       

      CKEDITOR.replace( 'description-ckeditor2', {
        extraPlugins: 'justify',
        allowedContent: true
      });         
      CKEDITOR.replace( 'description-ckeditor-market', {
        extraPlugins: 'justify',
        allowedContent: true
      });         
      CKEDITOR.replace( 'description-ckeditor-market1', {
        extraPlugins: 'justify',
        allowedContent: true
      });         
      CKEDITOR.replace( 'description-ckeditor-market2', {
        extraPlugins: 'justify',
        allowedContent: true
      });      
   //Adding-Validations-On-Home-Page-CMS
   $('#home_cms').validate({
   
   ignore: [],
   
   onfocusout: function (valueToBeTested) {
     $(valueToBeTested).valid();
   },
   
   highlight: function(element) {
     $('element').removeClass("error");
   },
   
   rules: {
     
     "first_section": {
       required: true
     },
     'second_section': {
       required: true
     },
     'third_section': {
       required: true
     },
     'copyright_info': {
       required: true
     },
     'description_ckeditor': {
       required: function(textarea) {
         CKEDITOR.instances[textarea.id].updateElement(); // update textarea
         var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
         return editorcontent.length === 0;
       }
     },      
     valueToBeTested: {
         required: true,
     }
   
   },
   });   
   
   
     //Submitting Register Form 
     $('#home-submit-btn').click(function()
     {
       if($('#home_cms').valid())
       {
         $('#home-submit-btn').prop('disabled', true);
         $('#home_cms').submit();
       }else{
         return false;
       }
     });    
   
   //Adding-Validations-On-Business-Page-CMS
   $('#business_cms').validate({
   onfocusout: function (valueToBeTested) {
     $(valueToBeTested).valid();
   },
   
   highlight: function(element) {
     $('element').removeClass("error");
   },
   
   rules: {
     
     "default_bg_image": {
     },
   
     valueToBeTested: {
         required: true,
     }
   
   },
   });   
   
   
     //Submitting Register Form 
     $('#business-submit-btn').click(function()
     {
       if($('#business_cms').valid())
       {
         $('#business-submit-btn').prop('disabled', true);
         $('#business_cms').submit();
       }else{
         return false;
       }
     });  
   
   //Adding-Validations-On-Login-Register-Page-CMS
   $('#login_cms').validate({
   onfocusout: function (valueToBeTested) {
     $(valueToBeTested).valid();
   },
   
   highlight: function(element) {
     $('element').removeClass("error");
   },
   
   rules: {
     
     "signup_bg_image": {
       
     },      
   
     "login_bg_image": {
       
     },
   
     valueToBeTested: {
         required: true,
     }
   
   },
   });   
   
   
     //Submitting Register Form 
     $('#login-submit-btn').click(function()
     {
       if($('#login_cms').valid())
       {
         $('#login-submit-btn').prop('disabled', true);
         $('#login_cms').submit();
       }else{
         return false;
       }
     });
   
</script>
@endsection