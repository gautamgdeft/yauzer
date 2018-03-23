$(document).ready(function()
{
  $("#avatar").change(function () {
  readURL(this);
});

  //Adding-Validations-To-New-Owner-Form
  $('#owner-form').validate({
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


  //Adding-Validations-Edit-Owner-Form
  $('#edit-owner-form').validate({
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
  $('#submit-owner-btn').click(function()
  {
    if($('#owner-form').valid())
    {
      $('#submit-owner-btn').prop('disabled', true);
      $('#owner-form').submit();
    }else{
      return false;
    }
  });

 //Sumitting-Edit-Owner-Form
  $('#submit-edit-owner-btn').click(function()
  {
    if($('#edit-owner-form').valid())
    {
      $('#submit-edit-owner-btn').prop('disabled', true);
      $('#edit-owner-form').submit();
    }else{
      return false;
    }
  });    

    //Only-Character-Add-Method
    $.validator.addMethod("character_with_space", function (value, element) {
    return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
    }, "Only letters are allowed.");       

}); //Ending Ready Functions


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