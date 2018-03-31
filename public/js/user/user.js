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

$(document).ready(function()
{
	
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
  	  noSpace: true,
      character_with_space: true,
      maxlength: 50, 
  },
  'email': {
      customemail: true,
  },
  'password': {
      noSpace: true,
      minlength: 6,
      maxlength: 12,
  },
  'password_confirmation': {
  	  equalTo: "#password",
      noSpace: true,
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
  $('#login_password_btn').click(function()
  {
    if($('#login-form').valid())
    {
      $('#login_password_btn').prop('disabled', true);
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
          number: true,
          minlength: 3,
          maxlength: 16,
      },

      "website": {
          noSpace: true,
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
      $('#yauzer_business').submit();
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

  //No-Space-Add-Method
  $.validator.addMethod("noSpace", function (value, element) {
      return value == '' || value.trim().length != 0;
  }, "No space please and don't leave it empty");



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
        $('#yauzer').prop('disabled', false).val('');
        $('#store_yauzer_btn').prop('disabled', false).val('');     

  }else{ 
  
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

}); //End-Ready-Function