//start of jQuery functions
jQuery(document).ready(function(jQuery) {

		//Start Submit Function
  		jQuery( "#annoucement" ).submit(function( event ) {

        event.preventDefault();

        var annoucement = jQuery("#annoucement-input").val();
				var trainerUsername = jQuery("#trainer-username").val();

        if(annoucement.length === 0){
          alert("Can't submit an empty annoucement!");
          return;
        }


				jQuery.ajax({
							type: "POST",
							url: ajaxurl,
							data: ({
								action: "update_client_annoucement",
								annoucement: annoucement,
								trainerUsername: trainerUsername
							}),
							success: function (response){
								alert(response);
								location.reload();
							}
						});



  		});
			//End Submit function

});
//End JQuery
