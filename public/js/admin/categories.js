$(document).ready(function()
{
  $("#avatar").change(function () {
  readURL(this);
});

  //Adding-Validations-on-Category-Form
  $('#category-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {

      "name": {
          maxlength: 50,         
          character_with_space: true, 
      },
      valueToBeTested: {
          required: true,
      }

    },

  });

  //Adding-Validations-on-Edit-Category-Form
  $('#edit-category-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {

      "name": {
          maxlength: 50,         
          character_with_space: true, 
      },
      valueToBeTested: {
          required: true,
      }

    },

  });


  //Adding-Validations-on-Sub-Category-Form
  $('#subcategory-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {

      "name": {
          maxlength: 50,         
          character_with_space: true, 
      },
      valueToBeTested: {
          required: true,
      }

    },

  });


  //Adding-Validations-on-Edit-Sub-Category-Form
  $('#edit-subcategory-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },

    rules: {

      "name": {
          maxlength: 50,         
          character_with_space: true, 
      },
      valueToBeTested: {
          required: true,
      }

    },

  });    

  //Submitting-Category-Form
  $('#category-submit-btn').click(function()
  {
    if($('#category-form').valid())
    {
      $('#category-submit-btn').prop('disabled', true);
      $('#category-form').submit();
    }else{
      return false;
    }
  });

  //Submitting-Edit-Category-Form
  $('#edit-category-submit-btn').click(function()
  {
    if($('#edit-category-form').valid())
    {
      $('#edit-category-submit-btn').prop('disabled', true);
      $('#edit-category-form').submit();
    }else{
      return false;
    }
  });

  //Submitting-Sub-Category-Form
  $('#subcategory-submit-btn').click(function()
  {
    if($('#subcategory-form').valid())
    {
      $('#subcategory-submit-btn').prop('disabled', true);
      $('#subcategory-form').submit();
    }else{
      return false;
    }
  });

  //Submitting-Edit-Sub-Category-Form
  $('#edit-subcategory-submit-btn').click(function()
  {
    if($('#edit-subcategory-form').valid())
    {
      $('#edit-subcategory-submit-btn').prop('disabled', true);
      $('#edit-subcategory-form').submit();
    }else{
      return false;
    }
  });  

    //Only-Character-Add-Method
    $.validator.addMethod("character_with_space", function (value, element) {
    return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
    }, "Only letters are allowed.");  

}); //End-Ready-Functions


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
