//Start load function that will load data by using ajax
	jQuery('#register-client').submit(function(event) {
		event.preventDefault();

				var trainerUsername = jQuery("#trainer-username").val();

				var clientUsername = jQuery("#my-client-list").val();


				if(clientUsername == "default"){
					alert("Can't register default value!");
					return;
				}


				//
				// var clientArray = [];
				//
				// if (jQuery("#available-clients input:checkbox:checked").length == 0){
				// 	alert("None of the clients are selected. Please select a client to register.");
				// 	event.preventDefault();
				// 	return;
				// }
				//
				// jQuery('input[type = "checkbox"]:checked').each(function(index) {
				// 	clientArray[index] = jQuery(this).val();
				// });
				//
				// console.log(clientArray, trainerUsername);


				jQuery.ajax({
							type: "POST",
							url: ajaxurl,
							data: ({
								action: "trainer_register_client",
								clientUsername: clientUsername,
								trainerUsername: trainerUsername
							}),
							success: function (response){
								alert(response);
								location.reload();
							}
						});


});
//End load function
