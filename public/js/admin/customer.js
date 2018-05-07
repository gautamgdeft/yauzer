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
        document.getElementById('address').value = place.name;
    });
}
google.maps.event.addDomListener(window, 'load', initialize);


$(document).ready(function()
{
  $("#avatar").change(function () 
  {
  readURL(this);
  });


  //Adding-Validations-Customer-Form
  $('#customer-form').validate({
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
          required: true,
          phoneUS: true,
          maxlength: 20,
          minlength: 10         
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

  //Adding-Validations-Edit-Customer-Form
  $('#edit-customer-form').validate({
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
          required: true,
          phoneUS: true,
          maxlength: 20,
          minlength: 10         
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
   
  //Submitting New Customer Form 
  $('#submit-customer-btn').click(function()
  {
    if($('#customer-form').valid())
    {
      $('#submit-customer-btn').prop('disabled', true);
      $('#customer-form').submit();
    }else{
      return false;
    }
  });

  //Submitting Edit Customer Form 
  $('#submit-edit-customer-btn').click(function()
  {
    if($('#edit-customer-form').valid())
    {
      $('#submit-edit-customer-btn').prop('disabled', true);
      $('#edit-customer-form').submit();
    }else{
      return false;
    }
  }); 

    //Only-Character-Add-Method
    $.validator.addMethod("character_with_space", function (value, element) {
    return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
    }, "Only letters are allowed.");   


    $.validator.addMethod("phoneUS", function (value, element) {
      return this.optional(element) || value == value.match(/^(?=.*[0-9])[- +()0-9]+$/);
    }, "Please specify a valid phone number.");     


$("#zipcode").keypress(function(event) {
  if ( event.which == 45 ) {
      event.preventDefault();
   }
});

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