//start of jQuery functions
jQuery(document).ready(function(jQuery) {

//Start load function that will load data by using ajax
	jQuery('#btnLogout').click(function(event) {

    jQuery.ajax({
          type: "POST",
          url: ajaxurl,
          data: ({
            action: "logout_user"
          }),
          success: function(){
            location.reload();
          }
        });


});
//End load function

		//Start Submit Function
  		jQuery( "#header-login" ).submit(function( event ) {

        event.preventDefault();

        var username = jQuery("#username-login").val();
        var password = jQuery("#password-login").val();

        if (password.length === 0 || username.length === 0){
          alert("Please enter your username and password");
          event.preventDefault();
          return;
        }

							//Call Ajax To send Data
  				jQuery.ajax({
  				      type: "POST",
  				      url: ajaxurl,
  				      data: ({
  				        action: "authenticate_user",
  								username: username,
									password: password
  				      }),
  				      success: function (data){
                  if (data == 1){
                    window.location.replace("http://localhost/Efitprogram/member-home");
                  }else{
                    alert("username and/or password is incorrect. Please try again.");
                  }
  				      }
  				    });


  		});
			//End Submit function

});
//End JQuery
