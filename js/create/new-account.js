

//Start load function that will load data by using ajax
	jQuery('#new-account').submit(function(event) {
		event.preventDefault();

		jQuery(this).find(':input').each(function(index, value){
			var that = jQuery(this),
					name = that.attr('id'),
					value = that.val();

					if (!name == "submit"){
							if (value.length === 0){
								alert("Indicated an empty field. Please fill in the empty field.");
								event.preventDefault();
								return;
							}
					}
		});

		var fName = jQuery('#fName').val();
		var lName = jQuery('#lName').val();
		var email = jQuery('#email').val();
		var username = jQuery('#username').val();
		var password = jQuery('#password').val();
		var repassword = jQuery('#re-password').val();
		var goal = jQuery('#goal').val();

		//check password length and match
		if (password.length < 7){
			alert("The password needs to be 8 characters or more!");
			return;
		}else if (!(password == repassword)){
			alert("The passwords do not match. Please try again.");
			return;
		}

        jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: ({
                action: "store_new_account",
                fName: fName,
								lName: lName,
								email: email,
								username: username,
								password: password,
								goal: goal
              }),
              success: function (response){
                window.location.replace("http://localhost/Efitprogram/member-home");
              }
            });


});
//End load function
