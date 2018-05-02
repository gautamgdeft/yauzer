function initialize() 
{
    var input = document.getElementById('address');
    var options = {    
    types: ['geocode'],
    componentRestrictions: {country: ["us", "ca"]}
    };
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };    
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];

            var addressType = addressType;
            switch (addressType) { 
              case 'locality': 
                document.getElementById('city').value = val;
                break;
              case 'administrative_area_level_1': 
                document.getElementById('state').value = val;
                break;
              case 'postal_code': 
                document.getElementById('zipcode').value = val;
                break;                  
            }            
          }
        }
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
        document.getElementById('address').value = place.name;
    });
}
google.maps.event.addDomListener(window, 'load', initialize);

// Used for checking business lat lng for another location
function newinitialize() 
{
    var input = document.getElementById('location');
    var options = {    
    types: ['geocode'],
    componentRestrictions: {country: ["us", "ca"]}
    };
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();

    var lat = place.geometry.location.lat();
    var lng = place.geometry.location.lng();
    
    document.getElementById('businesslatitude').value = place.geometry.location.lat();
    document.getElementById('businesslongitude').value = place.geometry.location.lng();    
});
}
google.maps.event.addDomListener(window, 'load', newinitialize);

$(document).ready(function()
{
	//$.validator.setDefaults({ ignore: ":hidden:not(select)" });

setTimeout(function() {
$('.alert-success').fadeOut('fast');
}, 8000); 

setTimeout(function() {
$('.alert-danger').fadeOut('fast');
}, 8000); 


$('[data-toggle="tooltip"]').tooltip(); 


//Adding-Validations-On-Sign-Up-Form
$('#register_form').validate({
onfocusout: function (valueToBeTested) {
  $(valueToBeTested).valid();
},

highlight: function(element) {
  $('element').removeClass("error");
},

rules: {
  
  "name": {
  	  character_with_space: true,
      maxlength: 50, 
  },
  'email': {
      customemail: true,
  },
  'password': {
      minlength: 6,
      maxlength: 12,
  },
  'password_confirmation': {
  	  equalTo: "#password",
      minlength: 6,
      maxlength: 12,
  },

  valueToBeTested: {
      required: true,
  }

},
});   


  //Submitting Register Form 
  $('#register_submit_btn').click(function()
  {
    if($('#register_form').valid())
    {
      $('#register_submit_btn').prop('disabled', true);
      $('#register_form').submit();
    }else{
      return false;
    }
  });


//Adding-Validations-On-Reset-Password-Form
$('#reset_password_email_form').validate({
onfocusout: function (valueToBeTested) {
  $(valueToBeTested).valid();
},

highlight: function(element) {
  $('element').removeClass("error");
},

rules: {
  
  'email': {
  	  required: true,
      customemail: true,
  },

  valueToBeTested: {
      required: true,
  }

},
}); 


  //Submitting Reset Password Form 
  $('#reset_password_btn').click(function()
  {
    if($('#reset_password_email_form').valid())
    {
      $('#reset_password_btn').prop('disabled', true);
      $('#reset_password_email_form').submit();
    }else{
      return false;
    }
  });


  //Adding-Validations-On-Login-in-Form
  $('#login-form').validate({
  onfocusout: function (valueToBeTested) {
    $(valueToBeTested).valid();
  },

  highlight: function(element) {
    $('element').removeClass("error");
  },

  rules: {
    
    'email': {
        customemail: true,
    },
    'password': {
        noSpace: true,
        minlength: 6,
        maxlength: 12,
    },

    valueToBeTested: {
        required: true,
    }

  },
  });


  //Submitting Login Form 
  $('#login_submit_btn').click(function()
  {
    if($('#login-form').valid())
    {
      $('#login_submit_btn').prop('disabled', true);
      $('#login-form').submit();
    }else{
      return false;
    }
  });


  //Adding-Validations-On-Yauzer-A-Business-Form
  $('#yauzer_business').validate({
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
          required: true,
          phoneUS: true,
          maxlength: 20,
          minlength: 10   
      },

      "website": {
          url: true,
      },

      "email": {
            customemail: true,
            remote: {
                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 url: "/checkemail",
                 type: "post",
                 dataType: 'text',
                 data: {
                   success: function(resp) {
                    console.log(resp);
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
  $('#store_yauzer_btn').click(function()
  {

   if($('#yauzer_business').valid())
    {  
      $('#store_yauzer_btn').prop('disabled', true);
      document.getElementById("yauzer_business").submit();
    }else{
      return false;
    }
  }); 


//Adding-Validations-On-User-Profile-Form
$('#user_profile_form').validate({
onfocusout: function (valueToBeTested) {
  $(valueToBeTested).valid();
},

highlight: function(element) {
  $('element').removeClass("error");
},

rules: {
  
  "firstname": {
      alphanumeric: true,
      character_with_space: true,
      maxlength: 25, 
  },  
  "lastname": {
      alphanumeric: true,
      character_with_space: true,
      maxlength: 25, 
  },
  "phone_number": {
          required: true,
          phoneUS: true,
          maxlength: 20,
          minlength: 10   
  },  
  "city": {
      required: true,
  },   
  "state": {
      required: true,
  },   
  "zipcode": {
      alphanumeric: true,
      required: true,
  },   
  "address": {
      required: true,
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


  //Submitting User-Profile-Form-Business Form 
  $('#user_profile_btn').click(function()
  {
    if($('#user_profile_form').valid())
    {
      $('#user_profile_btn').prop('disabled', true);
      $('#user_profile_form').submit();
    }else{
      return false;
    }
  });           


//Adding-Validations-On-User-Send-Directions-Form
$('#get_directions').validate({
onfocusout: function (valueToBeTested) {
  $(valueToBeTested).valid();
},

highlight: function(element) {
  $('element').removeClass("error");
},

rules: {
  
  "email": {
      customemail: true,
  },  

  valueToBeTested: {
      required: true,
  }

},

});   


  //Submitting Get-Directions-Form
  $('#get_direction_btn').click(function()
  {
    if($('#get_directions').valid())
    {
      $('#get_direction_btn').prop('disabled', true);
      $('#get_directions').submit();
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


  $.validator.addMethod("phoneUS", function (value, element) {
  return this.optional(element) || value == value.match(/^(?=.*[0-9])[- +()0-9]+$/);
}, "Please specify a valid phone number.");    





//Yauzer-Business-Checking-Business-Exist-In-Db
 
 $('#business_select').on('change', function() 
 {
  $('#yauzer_business').validate().resetForm();
  //If Business Is Not In Our Db
  if($(this).val() == 'other')
  {
        $('#yauzer_heading_text').text('Congratulations, you’re the first to Yauzer this business');
        $('#business_name').removeClass('hide');
        $('#business_location').addClass('hide');
        $('#category').removeClass('hide');
        $('#name').val('');
        $('#address').prop('disabled', false).val('');
        $('#city').prop('disabled', false).val('');
        $('#state').prop('disabled', false).val('');
        $('#zipcode').prop('disabled', false).val('');
        $('#phone_number').prop('disabled', false).val('');
        $('#website').prop('disabled', false).val('');
        $('#email').prop('disabled', false).val('');
        $('#yauzer').prop('disabled', false).val('');
        $('#store_yauzer_btn').prop('disabled', false).val('');     

  }else{ 
  
  $('#yauzer_heading_text').text('Welcome, you’re about to Yauzer a business');
  
  //If Business Exist In Our Db
  if(!$('#business_name').hasClass('hide')){
    $('#business_name').addClass('hide');
  }    

  $('#business_location').removeClass('hide');


  if(!$('#category').hasClass('hide')){
    $('#category').addClass('hide');
  }  

  if(!$('#subcategory').hasClass('hide')){
    $('#subcategory').addClass('hide');
  }
  
  //Again adding disabled property to all fields
  $('#address').prop('disabled', true);
  $('#city').prop('disabled', true);
  $('#state').prop('disabled', true);
  $('#zipcode').prop('disabled', true);
  $('#phone_number').prop('disabled', true);
  $('#website').prop('disabled', true);
  $('#email').prop('disabled', true);
  $('#yauzer').prop('disabled', true);
  $('#store_yauzer_btn').prop('disabled', true);   

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
        $('#yauzer').prop('disabled', false);
        $('#store_yauzer_btn').prop('disabled', false);

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


//Image Preview Code
$("#avatar").change(function () 
{
  readURL(this);
});

$("#zipcode").keypress(function(event) {
  if ( event.which == 45 ) {
      event.preventDefault();
   }
});

//Reset-Add-Yauzer-Form
  $('.reset_yauzer_form').click(function(){
       var v = $("#yauzer_business").validate();
       $(this).closest('form').find("input[type=text], textarea, select").val("");
       v.resetForm();
  });




  //Removing-Https-From-Url-While-Showing-Lising-Main
  $( ".business-detail" ).each(function( index ) {
     var originalUrl = $(this).find('.web').text();
     var urlNoProtocol = originalUrl.replace(/^https?\:\/\//i, "");
     $(this).find('.web').text(urlNoProtocol);
  });

  //For-Business-Detail
  var detail = $('.web-detail').text();
  var urlNoProtocola = detail.replace(/^https?\:\/\//i, "");
  $('.web-detail').text(urlNoProtocola);


 $('#shuffleBusiness').click(function() 
 {
        var lat =  $('#businesslatitude').val();
        var long = $('#businesslongitude').val();

        $.ajax({
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},      
         url: "/get-business",
         type: "post",
         dataType: "JSON",
         data: { 'lat': lat, 'long': long },
         success: function(response)
         { 
            //Firstly-Empty-the-previous values of select Refreshing-Chosen-box-after-Ajax-Hitting
            $('#business_select option').remove();

            if(response.status == 'success') 
            {
              $('#business_select').append('<option value="" disabled="" selected="">Choose Business you want to yauzer</option>');
              $(response.businesses).each(function(){
               $('#business_select').append("<option value='"+ this.id +"'>"+ this.name +"</option>");
              });
              $('#business_select').selectpicker('refresh');
            }else{           
               $('#business_select').append("<option value=''>No Business found for this location</option>"); 
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
 });

}); //End-Ready-Function



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

    function applyValidate(formid){
      $('#'+formid).validate({

        rules: {
          
          'yauzer': {
            required: true,
          },

          valueToBeTested: {
              required: true,
          }

        },
      });
   }     

   function applyEmailValidate(formid){
      
      $('#'+formid).validate({
        onfocusout: function (valueToBeTested) {
          $(valueToBeTested).valid();
        },

        highlight: function(element) {
          $('element').removeClass("error");
        },        
        rules: {
          
          'email': {
            required: true,
            customemail: true,
          },

          valueToBeTested: {
              required: true,
          }

        },
      });
   } 
