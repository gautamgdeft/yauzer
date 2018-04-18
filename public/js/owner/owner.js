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



$(document).ready(function()
{

  $.validator.setDefaults({ ignore: ":hidden:not(select)" });

  // validation of chosen on change
  if ($("select.chosen-select").length > 0) {
      $("select.chosen-select").each(function() {
          if ($(this).attr('required') !== undefined) {
              $(this).on("change", function() {
                  $(this).valid();
              });
          }
      });
  }  

   setTimeout(function() {
   $('.alert-success').fadeOut('fast');
   }, 8000); 

   setTimeout(function() {
   $('.alert-danger').fadeOut('fast');
   }, 8000); 


  $("#avatar").change(function () {
  readURL(this);
  });  


  //Adding-Validations-To-New-Owner-Form
  $('#owner_profile').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      "name": {
          maxlength: 50,
          character_with_space: true, 
      },
      "city": {
          character_with_space: true,
          maxlength: 50, 
      },
      "state": {
          character_with_space: true,
          maxlength: 50, 
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


  //Sumitting-New-Owner-Form
  $('#owner_profile_btn').click(function()
  {
    if($('#owner_profile').valid())
    {
      $('#owner_profile_btn').prop('disabled', true);
      $('#owner_profile').submit();
    }else{
      return false;
    }
  });


  //Adding-Validations-To-Owner-Change-Password
  $('#ownerChangePassword').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      "current-password": {
	      minlength: 6,
	      maxlength: 12,
          character_with_space: true, 
      },
      "new-password": {
	      minlength: 6,
	      maxlength: 12, 
      },
      "new-password_confirmation": {
	  	  equalTo: "#new-password",
	      minlength: 6,
	      maxlength: 12,
      },
      valueToBeTested: {
          required: true,
      }

    },
  });  

	  //Sumitting-Change-Password-Form
	  $('#change_password_btn').click(function()
	  {
	    if($('#ownerChangePassword').valid())
	    {
	      $('#change_password_btn').prop('disabled', true);
	      $('#ownerChangePassword').submit();
	    }else{
	      return false;
	    }
	  });


//Yauzer-Business-Checking-Business-Exist-In-Db
 
 $('#business_select').on('change', function() 
 {
  //If Business Is Not In Our Db
  if($(this).val() == 'other')
  {
        $('#business_name').removeClass('hide');
        $('#category').removeClass('hide');
        $('#name').val('');
        $('#address').prop('disabled', false).val('');
        $('#city').prop('disabled', false).val('');
        $('#state').prop('disabled', false).val('');
        $('#zipcode').prop('disabled', false).val('');
        $('#phone_number').prop('disabled', false).val('');
        $('#website').prop('disabled', false).val('');
        $('#email').prop('disabled', false).val('');
        $('#claim_business_btn').addClass('hide');     
        $('#submit_business').removeClass('hide');
        $('#checkPost').val('');

  }else{ 
  
  
  $('#checkPost').val('clain_business');     
  
  //If Business Exist In Our Db
  if(!$('#business_name').hasClass('hide')){
    $('#business_name').addClass('hide');
  }  

  if(!$('#category').hasClass('hide')){
    $('#category').addClass('hide');
  }  

  if(!$('#subcategory').hasClass('hide')){
    $('#subcategory').addClass('hide');
  }  

  if(!$('#submit_business').hasClass('hide')){
    $('#submit_business').addClass('hide');
  }
  
  //Again adding disabled property to all fields
  validator.resetForm();
  $('#address').prop('disabled', true);
  $('#city').prop('disabled', true);
  $('#state').prop('disabled', true);
  $('#zipcode').prop('disabled', true);
  $('#phone_number').prop('disabled', true);
  $('#website').prop('disabled', true);
  $('#email').prop('disabled', true);
  $('#claim_business_btn').removeClass('hide'); 
     

  $.ajax({
   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
   url: "/check-business",
   type: "post",
   dataType: "JSON",
   data: { 'id': $(this).val() },
   success: function(response)
   { 
      if(response.status == 'success') 
      {
        $('#address').val(response.business.address);
        $('#city').val(response.business.city);
        $('#state').val(response.business.state);
        $('#zipcode').val(response.business.zipcode);
        $('#phone_number').val(response.business.phone_number);
        $('#website').val(response.business.website);
        $('#email').val(response.business.email);
        $('#claim_business_btn').prop('disabled', false);

      }else{
       $('#msgs').html("<div class='alert alert-danger'>"+response.msg+"</div>"); 
      }
   },
   error: function( response ) 
   {
     if ( response.status === 422 ) 
     {
       $(this).html('Try Again');
       $('#msgs').html("<div class='alert alert-danger'>"+response.msg+"</div>");
     }
   }

 });

 }//End-if 

 }); 


 //Getting-Business-Subcategies-From-Category-OnChange
$('#business_category').on('change', function() 
{
     //If Business-Category-Id is present 
     if($(this).val() != '')
     {
        $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
         url: "/get-business-subcategory",
         type: "post",
         dataType: "JSON",
         data: { 'id': $(this).val() },
         success: function(response)
         { 
            //Firstly-Empty-the-previous values of select box
            $('#business_subcategory').html(' ');

            if(response.status == 'success') 
            {
              $(response.businessSubcategories).each(function(){
               $('#subcategory').removeClass('hide'); 
               $('#business_subcategory').append("<option value='"+ this.id +"'>"+ this.name +"</option>");
              });
            }else{
               $('#business_subcategory').append("<option value=''>No Subcategories Found</option>"); 
            }
            //Refreshing-Chosen-box-after-Ajax-Hitting
            $("#business_subcategory").trigger("chosen:updated");
         },
         error: function( response ) 
         {
           if ( response.status === 422 ) 
           {
             $(this).html('Try Again');
             $('#msgs').html("<div class='alert alert-danger'>"+response.msg+"</div>");
           }
         }

       });

     }else{

      //If Business category is not present
      $('#msgs').html("<div class='alert alert-danger'>Some error occured please choose category again.</div>");
     }
});


//Business-Subcategory-Multiple-Choosen
$(".businessSubcategory").chosen({
  width: "100%",
  placeholder_text_multiple: "Click to choose subcategories ..."
  });



  //Adding-Validations-On-Yauzer-A-Business-Form
  var validator = $('#yauzer_for_business').validate({
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

      "website": {
          url: true,
      },

      "email": {
            customemail: true,
            remote: {
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 url: "/owner/verify-email",
                 type: "post",
                 dataType: 'text',
                 data: {
                   success: function(resp) {
                         if(resp == "true" ) {
                         resp.parent().removeClass('error');
                         resp.remove();
                     }
                    }
                   }
                }
      },    
    
    valueToBeTested: {
        required: true,
    }

  },
  });


  //Submitting Yauzer-For-Business Form 
  $('#submit_business').click(function()
  {
    if(validator.valid())
    {
      $('#submit_business').prop('disabled', true);
      document.getElementById("yauzer_for_business").submit();
    }else{
      return false;
    }
  });   

  //Submitting Yauzer-For-Business Form 
  $('#claim_business_btn').click(function()
  {
    if(validator.valid())
    {
      $('#submit_business').prop('disabled', true);
      document.getElementById("yauzer_for_business").submit();
    }else{
      return false;
    }
  }); 


  //Adding-Validations-On-Biz-Basic-Information-Form
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

      valueToBeTested: {
          required: true,
      }

    },
    messages: {
        business_category: {
            required: 'Choose a business category',
        }       
    }     
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


  //Adding-Validations-On-Additional-Biz-Information
  $('#edit-additional-biz-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {

      "email": {
            customemail: true,
            remote: {
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 url: "/owner/verify-email",
                 type: "post",
                 dataType: 'text',
                 data: {
                   success: function(resp) {
                         if(resp == "true" ) {
                         resp.parent().removeClass('error');
                         resp.remove();
                     }
                    }
                   }
                }
      },     

      "phone_number": {
          number: true,
          minlength: 8,
          maxlength: 16,
      },        
      "fax_number": {
          number: true,
          minlength: 8,
          maxlength: 16,
      },
      "website": {
          url: true,
      },  
      valueToBeTested: {
          required: true,
      }

    },
    messages: {
        phone_number: {
            minlength: jQuery.format("Enter at least {0} digits"),
            maxlength: jQuery.format("Please enter no more than {0} digits."),
        }       
    }    
  });     

  $('#additional-biz-btn').click(function()
  {
    if($('#edit-additional-biz-form').valid())
    {
      $('#additional-biz-btn').prop('disabled', true);
      $('#edit-additional-biz-form').submit();
    }else{
      return false;
    }
  }); 




  //Only-Character-Add-Method
  $.validator.addMethod("character_with_space", function (value, element) {
  return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
  }, "Only letters are allowed.");

  //Email-Add-Method
  $.validator.addMethod("customemail", function (value, element) {
    return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
  }, "Please enter a valid email address.");  

  //Alphanumeric-Add-Method
  $.validator.addMethod("alphanumeric", function (value, element) {
    return this.optional(element) || /^[a-z\d\-_\s]+$/i.test(value);
  }, "Please enter alpha-numeric characters only.");  


//Reset-Add-Yauzer-Form
  $('.reset_form').click(function(){
        validator.resetForm();
  });


//Getting-Business-Subcategies-From-Category-OnChange
$('#business_category').on('change', function() 
{
     //If Business-Category-Id is present 
     if($(this).val() != '')
     {
        $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
         url: "/get-business-subcategory",
         type: "post",
         dataType: "JSON",
         data: { 'id': $(this).val() },
         success: function(response)
         { 
            //Firstly-Empty-the-previous values of select box
            $('#business_subcategory').html(' ');

            if(response.status == 'success') 
            {
              $(response.businessSubcategories).each(function(){
               $('#subcategory').removeClass('hide'); 
               $('#business_subcategory').append("<option value='"+ this.id +"'>"+ this.name +"</option>");
              });
            }else{
               $('#subcategory').addClass('hide');
               $('#business_subcategory').append("<option value=''>No Subcategories Found</option>"); 
            }
            //Refreshing-Chosen-box-after-Ajax-Hitting
            $("#business_subcategory").trigger("chosen:updated");
         },
         error: function( response ) 
         {
           if ( response.status === 422 ) 
           {
             $(this).html('Try Again');
             $('#msgs').html("<div class='alert alert-danger'>"+response.msg+"</div>");
           }
         }

       });

     }else{

      //If Business category is not present
      $('#msgs').html("<div class='alert alert-danger'>Some error occured please choose category again.</div>");
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
                url: "/owner/destroy-picture",
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

//Deleting Owner Business Speciality
$('.delete_speciality').click(function()
{
    var confirmation = confirm("Are you sure you want to delete this speciality?");
    if (confirmation) 
    {    
      var speciality_id = $(this).data('id');
      var specialLeft = $('ul.speciality_checks li').length
      
      $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
                url: "/owner/destroy-business-speciality",
                type: "post",
                dataType: "JSON",
                data: { 'id': $(this).data('id') },
                success: function(response)
                {
                  if ( response.status === 'success' ) 
                  {
                     $('#speciality_li_'+speciality_id).remove();
                     $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                     setTimeout(function(){
                          $('#msgs').fadeOut('fast');
                      },5000);
                     if(specialLeft == 1)
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

//Business-Info-By-admin
$(".businessInfo").chosen({
  width: "100%",
  placeholder_text_multiple: "Click to choose Predefined Business Info..."
  });


$('#edit-business-info').validate({

    errorPlacement: function (error, element) {
        
        if (element.is("select.chosen-select")) {
            // placement for chosen
            element.next("div.chosen-container").append(error);
        } else {
            // standard placement
            error.insertAfter(element);
        }
    },

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

//Submission-of-Business-Info-Form
$('#update-businessInfp-form-btn').click(function()
{
  if($('#edit-business-info').valid())
  {
    $('#update-businessInfp-form-btn').prop('disabled', true);
    $('#edit-business-info').submit();
  }else{
    return false;
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


//Function-For-Hours-Tab-Showing-TimePicker
$(function() { 
  
  $(".timepicker1").timepicker({
      showInputs: false
  });  
  
  var today = new Date();
  $("#valid_thru").datepicker({ 
        startDate: today, 
        autoclose: true,
        todayHighlight: true
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

});


//Validation on Respond Yauzer Form
  function applyValidate(formid){
    
      $('#'+formid).validate({

      rules: {
        
        'comment': {
          required: true,
        },

        valueToBeTested: {
            required: true,
        }

      },
    });
 } 