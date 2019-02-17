
//Start load function that will load data by using ajax
	jQuery('#new-account').submit(function(event) {
		event.preventDefault();

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
		var username = jQuery('#username').val();
		var password = jQuery('#password').val();
		var repassword = jQuery('#re-password').val();

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
                action: "check_available",
                fName: fName,
								lName: lName,
								email: email,
								username: username,
								password: password
              }),
              success: function (response){
								if(response == 4){
									alert("Please Enter Valid Characters For Your First Name and Last Name!");
								}else if(response == 1){
									alert("It Looks Like Your Email Is Invalid. Please Try Again!");
								}else if(response == 2){
									alert("It Looks Like Your Username Is Already Taken. Please Try Again!");
								}else if(response == 3){
									alert("It looks Like We have Your Email Registered with us already. Please Contact Us Directly!");
              	}else{
									var url = window.location.protocol+"//"+window.location.host + "/main/purchase-options";
									window.location.href = url;
								}
							}
            });


});
//End load function



//Start load function that will load data by using ajax
	jQuery('#new-account-trainer').submit(function(event) {
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
		var description = jQuery('#description').val();

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
                action: "store_trainer_account",
                fName: fName,
								lName: lName,
								email: email,
								username: username,
								password: password,
								description: description
              }),
              success: function (response){
								if(response == 1){
									//window.location.replace("http://localhost/main/home");
									event.submit();
								}else{
									alert(response);
								}
              }
            });


});
//End load function
