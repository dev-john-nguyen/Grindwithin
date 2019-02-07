

//Start load function that will load data by using ajax
	jQuery('#app-trainer').submit(function(event) {
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
    var certified = jQuery('#certified').val();
    var certifiedType = jQuery('#certified-type').val();
    var yearsExp = jQuery('#years-experience').val();
    var sportName = jQuery('#sport-name').val();
    var sportLvl = jQuery('#sport-level').val();
    var q1 = jQuery('#q1').val();
    var q2 = jQuery('#q1').val();
    var q3 = jQuery('#q3').val();

    if(certified == "default" || certified == null){
      alert("Please select yes or no to the question, 'Are you a certified trainer?'");
      return;
    }

        jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: ({
                action: "store_app_trainer",
                fName: fName,
								lName: lName,
								email: email,
								certified: certified,
								certifiedType: certifiedType,
								yearsExp: yearsExp,
								sportName: sportName,
								sportLvl: sportLvl,
								q1: q1,
								q2: q2,
                q3: q3
              }),
              success: function (response){
                if(response == 1){
                  alert("Thank you for submitting your application. You should hear from us within a week or so via email.");
                  location.reload();
                }else{
                  alert(response);
                }

              }
            });


});
//End load function
