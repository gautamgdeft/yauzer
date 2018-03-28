$(document).ready(function()
{
  //Adding-Validations-on-Business-Info-Form
  $('#business-info-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },
  highlight: function(element) {
    $('element').removeClass("error");
  },

    rules: {

      "name": {
          maxlength: 50,         
      },
      valueToBeTested: {
          required: true,
      }
    },

  });  

  //Adding-Validations-on-Edit-Business-Info-Form
  $('#edit-info-form').validate({
  onfocusout: function (valueToBeTested) {
      $(valueToBeTested).valid();
  },
  highlight: function(element) {
    $('element').removeClass("error");
  },

    rules: {

      "name": {
          maxlength: 50,         
      },
      valueToBeTested: {
          required: true,
      }
    },

  });


  //Submitting-Business-Info-Form
  $('#edit-info-submit-btn').click(function()
  {
    if($('#edit-info-form').valid())
    {
      $('#edit-info-submit-btn').prop('disabled', true);
      $('#edit-info-form').submit();
    }else{
      return false;
    }
  });  


	//Only-Character-Add-Method
	$.validator.addMethod("character_with_space", function (value, element) {
	return this.optional(element) || /^[a-zA-Z .]+$/i.test(value);
	}, "Only letters are allowed."); 


	// Changing Info Status Active/Inactive
	$('.active_info').click(function()
	{
	  $(this).html('Please wait..');
	  var info_id = $(this).data('id');

	  $.ajax({
	   headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
	   url: "/admin/update-info-status",
	   type: "post",
	   dataType: "JSON",
	   data: { 'id': $(this).data('id') },
	   success: function(response)
	   {
	     if ( response.status === 'success' ) 
	     {
	       $('#inactive_'+info_id).addClass('hide');
	       $('#inactive_'+info_id).html('Inactive'); 
	       $('#active_'+info_id).removeClass('hide');         
	       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
	     }else{
	       $('#active_'+info_id).addClass('hide');
	       $('#active_'+info_id).html('Active'); 
	       $('#inactive_'+info_id).removeClass('hide');         
	       $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
	     }
	   },
	   error: function( response ) 
	   {
	     if ( response.status === 422 ) 
	     {
	       $(this).html('Try Again');
	       $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
	     }
	   }

	 });    

	});


	// Deleting-Business-Info
	$(".delete_info").on("click", function() 
	{  
	  var confirmation = confirm("Are you sure you want to delete this business info?");
	  if (confirmation) 
	  {    
	  	$(this).html('Deleting...');
	  	var info_id = $(this).data('id');
	  	var tr_count = document.getElementById("business_info_table").getElementsByTagName("tr").length;
	  	
	  	$.ajax({
	  			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},    	
	              url: "/admin/destroy-business-info",
	              type: "post",
	              dataType: "JSON",
	              data: { 'id': $(this).data('id') },
	              success: function(response)
	              {
	                if ( response.status === 'success' ) 
	        				{
	        				   $('.tr_'+info_id).remove();
	        				   $('#msgs').html("<div class='alert alert-success'>"+response.msg+"</div>");
								
							    if(tr_count == 2)
								{
								 $('.dum').removeClass('hide');
								}	        				   
	        				}
	              },
	              error: function( response ) 
	              {
	                 if ( response.status === 422 ) 
	                 {
	                 	   $(this).html('Delete');
	                       $('#msgs').html("<div class='alert alert-error'>"+response.msg+"</div>");
	                 }
	              }


	      });
	  }
	    
	});	

}); //End-ready-function	