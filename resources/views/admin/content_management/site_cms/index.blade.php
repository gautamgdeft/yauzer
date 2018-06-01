@extends('layouts.admin')
@section('content')
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Site CMS
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Site CMS</li>
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
                  <h3 class="box-title">Home Page CMS</h3>
               </div>
               <form id="home_cms" role="form" action="{{ route('admin.update_home_cms') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}              
                  <div class="box-body">
                     <div class="form-group">
                        <label>Slider Box Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor">{{ $homecms->description_ckeditor }}</textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>First H1 Content:</label>
                        <input type="text" name="first_section" class="form-control" value="{{ $homecms->first_section }}">
                     </div>
                     <div class="form-group">
                        <label>Second H1 Content:</label>
                        <input type="text" name="second_section" class="form-control" value="{{ $homecms->second_section }}">
                     </div>
                     <div class="form-group">
                        <label>Third H1 Content:</label>
                        <input type="text" name="third_section" class="form-control" value="{{ $homecms->third_section }}">
                     </div>
                     <div class="form-group">
                        <label>Copyright Information:</label>
                        <input type="text" name="copyright_info" class="form-control" value="{{ $homecms->copyright_info }}">
                     </div>
                  </div>
                  <div class="box-footer">
                     <button id="home-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>

            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Result Page Content</h3>
               </div>
               <form id="result_cms" role="form" action="{{ route('admin.update_result_section') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Default Background Image:</label>
                        <input type="file" name="default_bg_image" class="form-control" id="result_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="image_result" src="/uploads/siteCMSAvatars/{{ $result_cms->default_bg_image }}" style="height: 45px; width: 80px;">                                            
                     </div>
                     <div class="form-group">
                        <label>Image Box Content:</label>
                        <div class="input-group">
                           <textarea class="description-ckeditor" name="description_ckeditor" id="description-ckeditor1">{{ $result_cms->description_ckeditor }}</textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Button Text:</label>
                        <input type="text" name="first_section" class="form-control" value="{{ $result_cms->first_section }}">
                     </div>
                     <div class="form-group">
                        <label>Button Link:</label>
                        <input type="text" name="second_section" class="form-control" value="{{ $result_cms->second_section }}">
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
                  <h3 class="box-title">Business Page</h3>
               </div>
               <form id="business_cms" role="form" action="{{ route('admin.update_business_image') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                
                  <div class="box-body">
                     <div class="form-group">
                        <label>Default Background Image</label>
                        <input type="file" name="default_bg_image" class="form-control" id="default_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="image_src" src="/uploads/siteCMSAvatars/{{ $default_bg_image->default_bg_image }}" style="height: 45px; width: 200px;">
                     </div>                     
                     <div class="form-group">
                        <label>Picture Coming Soon</label>
                        <input type="file" name="picture_coming_soon" class="form-control" id="picture_coming_soon" onchange="ValidateSingleInput(this);">
                        <img id="image_src3" src="/uploads/siteCMSAvatars/{{ $default_bg_image->picture_coming_soon }}" style="height: 45px; width: 200px;">
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
                  <h3 class="box-title">Log in/Sign Up Page Images</h3>
               </div>
               <form id="login_cms" role="form" action="{{ route('admin.update_log_images') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Sign Up Background Image:</label>
                        <input type="file" name="signup_bg_image" class="form-control" id="signup_bg_image" onchange="ValidateSingleInput(this);">
                        <img id="image_src1" src="/uploads/siteCMSAvatars/{{ $login_signup_img->signup_bg_image }}" style="height: 45px; width: 200px;">                                            
                     </div>
                     <div class="form-group">
                        <label>Login Background Image:</label>
                        <input type="file" id="login_bg_image" name="login_bg_image" class="form-control" onchange="ValidateSingleInput(this);">
                        <img id="image_src2" src="/uploads/siteCMSAvatars/{{ $login_signup_img->login_bg_image }}" style="height: 45px; width: 200px;">                                            
                     </div>
                     <div class="form-group">
                        <label>Login Header Image</label>
                        <input type="file" name="default_bg_image" class="form-control" id="login_header_image" onchange="ValidateSingleInput(this);">
                        <img id="image_src4" src="/uploads/siteCMSAvatars/{{ $login_signup_img->default_bg_image }}" style="height: 35px; width: 519px;">
                     </div>                       
                     <div class="form-group">
                        <label>Business Login Heading:</label>
                        <textarea class="description-ckeditor" name="first_section" id="first-section-ckeditor">{{ $login_signup_img->first_section }}</textarea>
                     </div>                     
                  </div>
                  <div class="box-footer">
                     <button id="login-submit-btn" type="submit" class="btn btn-primary">Update</button>
                  </div>
               </form>
            </div>

            <div class="box box-info">
               <div class="box-header">
                  <h3 class="box-title">Social Share Messages</h3>
               </div>
               <form id="social_share_cms" role="form" action="{{ route('admin.update_business_share') }}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}                                  
                  <div class="box-body">
                     <div class="form-group">
                        <label>Business Detail Share:</label>
                        <textarea class="description-ckeditor" name="description_ckeditor" id="social-share-first">{{ $socialShareCms->description_ckeditor }}</textarea>
                     </div> 
                      <div class="form-group">
                        <label>User Dashoard Left Sidebar Share:</label>
                        <textarea class="description-ckeditor" name="first_section" id="social-share-second">{{ $socialShareCms->first_section }}</textarea>
                     </div> 
                      <div class="form-group">
                        <label>Owner Dashboard Popup Share:</label>
                        <textarea class="description-ckeditor" name="second_section" id="social-share-third">{{ $socialShareCms->second_section }}</textarea>
                      </div>                      
                      <div class="form-group">
                        <label>Owner Yauzer Section Share:</label>
                        <textarea class="description-ckeditor" name="third_section" id="social-share-fourth">{{ $socialShareCms->third_section }}</textarea>
                      </div>                     
                  </div>
                  <div class="box-footer">
                     <button id="login-submit-btn" type="submit" class="btn btn-primary">Update</button>
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
      
      $( 'textarea.description-ckeditor').each( function() {

          CKEDITOR.replace( $(this).attr('id') , {
           extraPlugins: 'justify'
          });

      });      
      // CKEDITOR.replace( 'description-ckeditor', {
      //   extraPlugins: 'justify'
      // });
      // CKEDITOR.replace( 'description-ckeditor1', {
      //   extraPlugins: 'justify'
      // });
      // CKEDITOR.replace( 'first-section-ckeditor', {
      //   extraPlugins: 'justify'
      // });
      // CKEDITOR.replace( 'social-share-first', {
      //   extraPlugins: 'justify'
      // });      
      // CKEDITOR.replace( 'social-share-second', {
      //   extraPlugins: 'justify'
      // });       
      // CKEDITOR.replace( 'social-share-third', {
      //   extraPlugins: 'justify'
      // });        
      // CKEDITOR.replace( 'social-share-fourth', {
      //   extraPlugins: 'justify'
      // });      
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