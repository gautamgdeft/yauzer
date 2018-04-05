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
          minlength: 8,
          maxlength: 16,
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
                url: "/admin/destroy-picture",
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
  
//Validations-on-Might-Interseted-Business-Form
$('#edit-interested_businesses-form').validate({

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


//Submission-of-Might-Interseted-Business-Form
$('#update-interested_businesses-form-btn').click(function()
{
  if($('#edit-interested_businesses-form').valid())
  {
    $('#update-interested_businesses-form-btn').prop('disabled', true);
    $('#edit-interested_businesses-form').submit();
  }else{
    return false;
  }
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


$('.delete_yauzer').click(function()
{
    var confirmation = confirm("Are you sure you want to delete this yauzer?");
    if (confirmation) 
    {    
      var yauzer_id = $(this).data('id');
      var yauzerLeft = $('.commentboxlist').length
      
      $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
                url: "/admin/destroy-business-yauzer",
                type: "post",
                dataType: "JSON",
                data: { 'id': $(this).data('id') },
                success: function(response)
                {
                  if ( response.status === 'success' ) 
                  {
                     $('#yauzer_li_'+yauzer_id).remove();
                     $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
                     setTimeout(function(){
                          $('#msgs').fadeOut('fast');
                      },5000);
                     if(yauzerLeft == 1)
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

$('.delete_speciality').click(function()
{
    var confirmation = confirm("Are you sure you want to delete this speciality?");
    if (confirmation) 
    {    
      var speciality_id = $(this).data('id');
      var specialLeft = $('ul.speciality_checks li').length
      
      $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},     
                url: "/admin/destroy-business-speciality",
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

//Might be interested Business working
$(".limitedNumbChosen").chosen({
  width: "100%",
  max_selected_options: 4,
  placeholder_text_multiple: "Click to choose Interested Businesses..."
  })
  .bind("chosen:maxselected", function (){
      window.alert("You reached your limited number of selections which is 4 selections!");
  })

//Business-Info-By-admin
$(".businessInfo").chosen({
  width: "100%",
  placeholder_text_multiple: "Click to choose Predefined Business Info..."
  });

$("#zipcode").keypress(function(event) {
  if ( event.which == 45 ) {
      event.preventDefault();
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





    $(document).ready(function () {

            //Horizontal Tab
            $('#parentHorizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });

            // Child Tab
            $('#ChildVerticalTab_1').easyResponsiveTabs({
                type: 'vertical',
                width: 'auto',
                fit: true,
                tabidentify: 'ver_1', // The tab groups identifier
                activetab_bg: '#fff', // background color for active tabs in this group
                inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
                active_border_color: '#c1c1c1', // border color for active tabs heads in this group
                active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
            });

            //Vertical Tab
            $('#parentVerticalTab').easyResponsiveTabs({
                type: 'vertical', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true, // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                tabidentify: 'hor_1', // The tab groups identifier
                activate: function (event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#nested-tabInfo2');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
        });

