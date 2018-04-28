
//start of jQuery functions
jQuery(document).ready(function(jQuery) {

//Start load function that will load data by using ajax
	jQuery('#display').click(function(event) {
		event.preventDefault();

jQuery.ajax({
			type: "POST",
			url: ajaxurl,
			async: false,
			data: ({
				action: "get_data",
			}),
			dataType: "json",
			success: function (data){
				populateProgram(data);
			},
      error: function (data) {
        alert("Failed");
      }
		});


});
//End load function

		//Start Submit Function
  		jQuery( "#main_form" ).submit(function( event ) {

  						event.preventDefault();

							var i = 1;
							var formLength = jQuery("#frm4 *").length;
							var numBoolean, repsBoolean, percentBoolean;
							var numAlert = "Please numbers only!";
							var repsAlert = "Number of reps (separated by commas) need to match number of sets. Example sets[5] and reps[1,2,3,4,5]";
							var percentAlert = "Number of percents (separated by commas) need to match number of sets. Example sets[5] and percent[80,80,85,90,90]";

							//Start While Loop For Error Checks
							while(i <= formLength){

								var resultRep = (jQuery("#reps" + i).val()).split(",");
								var resultPercent = (jQuery("#percent" + i).val()).split(",");
								var resultSet = jQuery("#sets" + i).val();

								//default css to default style
								jQuery("#reps" + i).css("border-color", '');
								jQuery("#sets" + i).css("border-color", '');
								jQuery("#percent" + i).css("border-color", '');

								//Error Loop check to check if the values entered are numbers
								for (var y = 0; y < resultRep.length; y++){
									//check if reps is a number
											if (!jQuery.isNumeric(resultRep[y])){
												jQuery("#reps" + i).focus();
												jQuery("#reps" + i).css("border-color", "red");
												numBoolean = false;
											}
									}
								//End Error Loop Check for Reps Number

								//Error Loop check to check if percent are numbers
							for (var y = 0; y < resultPercent.length; y++){
								if (!jQuery.isNumeric(resultPercent[y])){
									jQuery("#percent" + i).focus();
									jQuery("#percent" + i).css("border-color", "red");
									numBoolean = false;
								}
							}
							//End Error Loop for percent numbers

										//If statement to check if the sets number matches the amount of reps entered
										if(resultRep.length != resultSet){
													jQuery("#reps" + i).focus();
													jQuery("#reps" + i).css("border-color", "red");
													jQuery("#sets" + i).css("border-color", "red");
													repsBoolean = false;
										//check if percent count is equal to sets number
											}else if(resultPercent.length != resultSet){
												jQuery("#percent" + i).focus();
												jQuery("#percent" + i).css("border-color", "red");
												jQuery("#sets" + i).css("border-color", "red");
												percentBoolean = false;
											}



								i++;
						}
						//End While Loop For Error Checks


						//Check if there are any errors and then throw alert and false
						if (numBoolean == false){
							alert(numAlert);
							return;
						}else if (repsBoolean == false){
							alert(repsAlert);
							return;
						}else if (percentBoolean == false){
							alert(percentAlert);
							return;
						}


  						var weekVal, dayVal, programVal;
  						var liftArray = [];
  						var data;
  						//looping through the form and find elments that have name
  						//storing all of the elements in liftArray
  						jQuery(this).find('[name]').each(function(index, value){
  							var that = jQuery(this),
  									name = that.attr('name'),
  									value = that.val();

  									liftArray[index] = [name, value];

  						});


  						//grabbing the first two elements of the array which are:
  						//Select_week and Select_day
  						//Splicing these two elements to form the complete liftArray
  						// programVal, weekVal, dayVal, and liftArray all fully defined
							programVal = liftArray[0][1];
  						weekVal = liftArray[1][1];
  						dayVal = liftArray[2][1];

							if (programVal == "select" || weekVal == "select" || dayVal == "select"){
								alert("Please select program, week, and dayVal before submitting the form!");
								return;
							}

  						liftArray.splice(0, 3);

							//Call Ajax To send Data
  				jQuery.ajax({
  				      type: "POST",
  				      url: ajaxurl,
  				      data: ({
  				        action: "send_data",
  				        liftArray: liftArray,
  								weekVal: weekVal,
  								dayVal: dayVal,
									programVal: programVal
  				      }),
  				      success: function (response){
  				        alert(response);
  				      }
  				    });


  		});
			//End Submit function

});
//End JQuery
