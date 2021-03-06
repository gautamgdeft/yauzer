    $(document).ready(function(){
        setTimeout(function() {
          $('.alert-success').fadeOut('fast');
        }, 5000); // <-- time in milliseconds


    $('[data-toggle="tooltip"]').tooltip(); 




	  $("#default_bg_image").change(function () 
	  {
	   readURL(this);
	  });	  
	  $("#signup_bg_image").change(function () 
	  {
	   readURLSignup(this);
	  });	  
    $("#login_bg_image").change(function () 
    {
     readURLLogin(this);
    });	  
    $("#picture_coming_soon").change(function () 
    {
     readURLSoon(this);
    });    
    $("#result_bg_image").change(function () 
    {
     readResultImg(this);
    });
    $("#login_header_image").change(function () 
    {
     readHeaderImg(this);
    });    
    $("#market_bg_image").change(function () 
	  {
     readMarketImg(this);
	  });


//Rating removing Stars text
  $('.rating-stars').mouseover(function(){
     if($('.caption').find('span').text() == ''){ $('.caption').addClass('hide'); }else{$('.caption').removeClass('hide');}
  });
  $('.rating-stars').mouseout(function(){
    $('.caption').addClass('hide');
  });
    $('.caption').addClass('hide');

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

        $('#default_bg_image').removeClass('validate_error');
        $("#default_bg_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function readURLSignup(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src1').css('display', 'block');
        $('#image_src1').attr('src', e.target.result);

        $('#signup_bg_image').removeClass('validate_error');
        $("#signup_bg_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function readURLLogin(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src2').css('display', 'block');
        $('#image_src2').attr('src', e.target.result);

        $('#login_bg_image').removeClass('validate_error');
        $("#login_bg_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function readURLSoon(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src3').css('display', 'block');
        $('#image_src3').attr('src', e.target.result);

        $('#picture_coming_soon').removeClass('validate_error');
        $("#picture_coming_soon").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function readResultImg(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_result').css('display', 'block');
        $('#image_result').attr('src', e.target.result);

        $('#result_bg_image').removeClass('validate_error');
        $("#result_bg_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function readHeaderImg(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#image_src4').css('display', 'block');
        $('#image_src4').attr('src', e.target.result);

        $('#login_header_image').removeClass('validate_error');
        $("#login_header_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}
function readMarketImg(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#market_result').css('display', 'block');
        $('#market_result').attr('src', e.target.result);

        $('#market_bg_image').removeClass('validate_error');
        $("#market_bg_image").next('label').remove();
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//  End Image Preview 