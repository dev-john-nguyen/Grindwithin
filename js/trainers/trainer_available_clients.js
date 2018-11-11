//Start load function that will load data by using ajax
	jQuery('#available-clients').submit(function(event) {
		event.preventDefault();

				var trainerUsername = jQuery("#trainer-username").val();

				var clientArray = [];

				if (jQuery("#available-clients input:checkbox:checked").length == 0){
					alert("None of the clients are selected. Please select a client to register.");
					event.preventDefault();
					return;
				}

				jQuery('input[type = "checkbox"]:checked').each(function(index) {
					clientArray[index] = jQuery(this).val();
				});

				console.log(clientArray, trainerUsername);


				jQuery.ajax({
							type: "POST",
							url: ajaxurl,
							data: ({
								action: "trainer_register_client",
								clientArray: clientArray,
								trainerUsername: trainerUsername
							}),
							success: function (response){
								alert(response);
								location.reload();
							}
						});


});
//End load function
