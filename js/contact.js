jQuery("#review-form").submit(function(e){

  e.preventDefault();

  jQuery(this).find(':input').each(function(index, value){
    var that = jQuery(this),
        name = that.attr('id'),
        value = that.val();

        if (!name == "submit"){
            if (value == ""){
              alert("Indicated a empty field. Please fill in the empty field.");
              event.preventDefault();
              return;
            }
        }

  });

		var fName = jQuery('#fName').val();
    var lName = jQuery('#lName').val();
    var email = jQuery('#email').val();
  	var body = jQuery('#body').val();

  jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: ({
          action: "send_email",
          fName: fName,
          lName: lName,
          email: email,
          body: body
        }),
        success: function (response){
          if(response == 0){
            alert("I apologize, but we are having trouble sending the form. Please contact us via email directly.");
          }else{
            alert("Form was successfully sent! Thank you for contacting us!");
          }
        }
      });


});
