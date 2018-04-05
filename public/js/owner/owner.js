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

    //Only-Character-Add-Method
    $.validator.addMethod("character_with_space", function (value, element) {
    return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
    }, "Only letters are allowed.");      

}); //End-ready-function	