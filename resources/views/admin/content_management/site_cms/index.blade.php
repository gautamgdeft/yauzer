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
                        </div><!-- /.col (left) -->

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

                                </div><!-- /.box-body -->

	                         <div class="box-footer">
	                           <button id="business-submit-btn" type="submit" class="btn btn-primary">Update</button>
	                         </div>  
                            </form>                              
                            </div><!-- /.box -->


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

                                </div>
                             <div class="box-footer">
	                           <button id="login-submit-btn" type="submit" class="btn btn-primary">Update</button>
	                         </div> 
	                         </form>	                                 
                            </div>


                        </div><!-- /.col (right) -->
                    </div><!-- /.row -->                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

@endsection


@section('custom_scripts')

 <script type="text/javascript">
     
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
        required: true
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
        required: true
      },      

      "login_bg_image": {
        required: true
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