@extends('layouts.admin')
@section('content')


<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1> Edit Business </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Edit Business</li>
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
      
     

      <div class="box">

         <div class="custom-tabing"> 
         <ul class="nav nav-tabs responsive" id="myTab">
          <li class="active"><a href="#business_detail">Business Detail</a></li>
          <li><a href="#business_hours">Business Hours</a></li>
          <li><a href="#business_pictures">Business Pictures</a></li>
        </ul>

        <div class="tab-content responsive">
          <div class="tab-pane active" id="business_detail">
             @include('admin/business_listing/partials/business_form/business_form  ')         
          </div>
          
          <div class="tab-pane" id="business_hours">
             @if(empty ( $businessHours->id ))
               @include('admin/business_listing/partials/business_hours/show_business_hours')         
             @else
               @include('admin/business_listing/partials/business_hours/updated_business_hours')
             @endif
          </div>
          
          <div class="tab-pane" id="business_pictures">
             @include('admin/business_listing/partials/business_pictures/edit_business_pictures')
          </div>  

        </div>
      </div>

      </div>
      <!-- /.box -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
@endsection




@section('custom_scripts')
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript">
    function initialize() {
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize); 
</script>

<script type="text/javascript">

$(function() { 
  
  $(".timepicker1").timepicker({
      showInputs: false
  });

});

$(document).ready(function()
{
  $("#avatar").change(function () {
  readURL(this);
   });  

  $('.business_checkbox').change(function() {
    
      if(this.checked) {
       $(this).closest('.test-sam').next('.text-right').removeClass('hide');
       $(this).closest('.test-sam').find("input[type='hidden']").val(1);
      }else{
       $(this).closest('.test-sam').next('.text-right').addClass('hide');
       $(this).closest('.test-sam').find("input[type='hidden']").val(0);
      }
      
  });

  // Deleting-Picture
  $('.delete_picture').click(function()
  {
    var confirmation = confirm("Are you sure you want to delete this picture?");
    if (confirmation) 
    {    
      var picture_id = $(this).data('id');
      var imagesLeft = $('.thumbnail-pic').length
      $.ajax({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
                url: "{{ route('admin.destroy_business_picture') }}",
                type: "post",
                dataType: "JSON",
                data: { 'id': $(this).data('id') },
                success: function(response)
                {
                  if ( response.status === 'success' ) 
                  {
                     $('.img_'+picture_id).remove();
                     $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                     setTimeout(function(){
                          $('#msgs').fadeOut('fast');
                      },5000);
                     if(imagesLeft == 1)
                     {
                        $('.dum').removeClass('hide');
                     }
                  }
                },
                error: function( response ) 
                {
                   if ( response.status === 422 ) 
                   {
                     $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
                     setTimeout(function(){
                          $('#msgs').fadeOut('fast');
                      },5000);
                   }
                }


        });
    }
      
  });     
 
});

/*---- Start Function For Checking Image Extension For Valid Image Selection ---*/

var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];

function ValidateSingleInput(oInput) {
    
    if (oInput.type == "file") {
      var sFileName = oInput.value;

      if (sFileName.length > 0) {
        var blnValid = false;
        for (var j = 0; j < _validFileExtensions.length; j++) 
        {
          var sCurExtension = _validFileExtensions[j];
          if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) 
          {
            blnValid = true;
            break;
          }
        }

        if (!blnValid) {

          alert('Sorry ! Allowed image extensions are .JPG, .JPEG, .GIF, .PNG');

          // swal("Sorry !", "Allowed image extensions are .JPG, .JPEG, .GIF, .PNG")
          oInput.value = "";
          return false;
        }
      }
    }
return true;
}

/*---- End Function For Checking Image Extension For Valid Image Selection ---*/ 

// Start Image Preview

function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src').css('display', 'block');
        $('#image_src').attr('src', e.target.result);

        $('#avatar').removeClass('validate_error');
        $("#avatar").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//  End Image Preview 
  
  $( 'ul.nav.nav-tabs  a' ).click( function ( e ) {
    e.preventDefault();
    $( this ).tab( 'show' );
  } );  

  (function($) {
      fakewaffle.responsiveTabs(['xs', 'sm']);
  })(jQuery);
</script>
@endsection