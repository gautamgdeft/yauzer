function initialize() 
{
    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });
}
google.maps.event.addDomListener(window, 'load', initialize);


//Function-For-Hours-Tab-Showing-TimePicker
$(function() { 
  
  $(".timepicker1").timepicker({
      showInputs: false
  });  
  
  var today = new Date();
  $("#valid_thru").datepicker({ 
        startDate: today, 
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true
  });

});


$(document).ready(function()
{
  $("#avatar").change(function () {
  readURL(this);
   });  

  //Adding-Validations-On-Business-Form
  $('#edit-business-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      "name": {
          maxlength: 50,         
          alphanumeric: true, 
      },    

      "phone_number": {
          number: true,
          minlength: 3,
          maxlength: 16,
      },
      valueToBeTested: {
          required: true,
      }

    },
  });     

  $('#submit-business-form-btn').click(function()
  {
    if($('#edit-business-form').valid())
    {
      $('#submit-business-form-btn').prop('disabled', true);
      $('#edit-business-form').submit();
    }else{
      return false;
    }
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

//Validations-on-Discount-Form
$('#edit-business-discount-form').validate({
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
 
//Submission-of-Discount-Form
$('#update-discount-form-btn').click(function()
{
  if($('#edit-business-discount-form').valid())
  {
    $('#update-discount-form-btn').prop('disabled', true);
    $('#edit-business-discount-form').submit();
  }else{
    return false;
  }
});  

}); //End-ready-function


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