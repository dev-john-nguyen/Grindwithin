var selectListElements = ["none", "back squat", "hang clean", "power clean", "snatch", "front squat", "bench"];

			function populateProgram(itemMain) {
			var week = document.getElementById("select_week").value;
			var day = document.getElementById("select_day").value;
			var program = document.getElementById("program_name").value;
			var submit_form = document.getElementById("submit_form");
			var position = "";
			var form_name;
			//var selectListElements = ["none", "back squat", "hang clean", "power clean", "snatch", "front squat", "bench"];

			jQuery("#frm0, #frm1, #frm2, #frm3, #frm4, #frm5, #frm6").empty();

			//Determine What array by checking Week and Day

			if(week == "select" && day == "select" && program == "select"){
				alert("Please Choose the week and day of the program!");
				submit_form.disabled = true;
				return false;
			}else if(week == "select"){
				alert("Please Choose the week of the program!");
				submit_form.disabled = true;
				return false;
			}else if(day == "select"){
				alert("Please Choose the day of the program!");
				submit_form.disabled = true;
				return false;
			}else if (program == "select"){
				alert("Please Choose the program!");
				submit_form.disabled = true;
				return false;
			}

			if (itemMain != null){
				for(j = 0; j < itemMain.length; j++){

				if(itemMain[j][1] == program && itemMain[j][2] == week && itemMain[j][3] == day){
				position = j;
				}

			}
		}

			if(position === ""){
				alert(week + " and " + day + " could not be found!");
				populate_unfound_Program();
				submit_form.disabled = false;
				return false;
			}

//the length of the array to loop through all the data values
			var lengthArray = itemMain[position][4].length - 1;
//Position determines what table we are looking at
//3 is the column ("lift") of the table
			for (i = 0; i <= lengthArray; i++){
			var input = document.createElement('input');
			//grab data name
			var itemMainName = itemMain[position][4][i][0];
			//grab data value
			var itemMainValue = itemMain[position][4][i][1];

				if (itemMainName.includes("group")){
					form_name = document.getElementById("frm" + 0);
					input.type = "text";
							input.id = itemMainName;
							input.name = itemMainName;
					input.value = itemMainValue;
					input.required = true;
					form_name.appendChild(input);
			}else if (itemMainName.includes("lift")){
					form_name = document.getElementById("frm" + 1);
					input.type = "text";
							input.id = itemMainName;
							input.name = itemMainName;
					input.value = itemMainValue;
					input.required = true;
					form_name.appendChild(input);
				}else if (itemMainName.includes("percent")){
					form_name = document.getElementById("frm" + 2);
					input.type = "text";
							input.id = itemMainName;
							input.name = itemMainName;
					input.value = itemMainValue;
							input.required = true;
							form_name.appendChild(input);
				}else if (itemMainName.includes("sets")){
					form_name = document.getElementById("frm" + 3);
					input.type = "number";
							input.id = itemMainName;
							input.name = itemMainName;
					input.value = itemMainValue;
							input.required = true;
							form_name.appendChild(input);
				}else if (itemMainName.includes("reps")){
					form_name = document.getElementById("frm" + 4);
					input.type = "text";
							input.id = itemMainName;
							input.name = itemMainName;
					input.value = itemMainValue;
							input.required = true;
							form_name.appendChild(input);
				}else if (itemMainName.includes("select")){
					form_name = document.getElementById("frm" + 5);
					var selectList = document.createElement("select");
					selectList.id = itemMainName;
					selectList.name = itemMainName;
					selectList.required = true;

					for (p = 0; p < selectListElements.length; p++){
						var option = document.createElement("option");
						option.value = selectListElements[p];
						option.text = selectListElements[p];
						if (selectListElements[p] == itemMainValue) {
							option.selected = true;
						}
						selectList.appendChild(option);
						form_name.appendChild(selectList);

					}

				}else if (itemMainName.includes("description")){
					form_name = document.getElementById("frm" + 6);
					input.type = "text";
					input.id = itemMainName;
					input.name = itemMainName;
					input.value = itemMainValue;
					input.required = true;
					form_name.appendChild(input);
				}else{
					return alert("Error Loading all of the data");
				}



			}
			submit_form.disabled = false;
			return false;

}


			function populate_unfound_Program() {

			var lengthArray = 4;

			for (i = 0; i <= lengthArray; i++){

				 for (j = 0; j <= 6; j++){

			var form_name = document.getElementById("frm" + j);
			var input = document.createElement('input');
						switch (j){
						case 0:
							input.type = "text";
							input.placeholder = "Group";
							input.id = "group" + (i + 1);
							input.name = "group" + (i + 1);
							input.required = true;
							form_name.appendChild(input);
							break;
						case 1:
							input.type = "text";
							input.placeholder = "Lift";
							input.id = "lift" + (i + 1);
								input.name = "lift" + (i + 1);
								input.required = true;
								form_name.appendChild(input);
							break;
						case 2:
							input.type = "text";
							input.placeholder = "Percentage";
							input.id = "percent" + (i + 1);
								input.name = "percent" + (i + 1);
								input.required = true;
								form_name.appendChild(input);
							break;
						case 3:
							input.type = "number";
							input.placeholder = "Sets";
							input.id = "sets" + (i + 1);
								input.name = "sets" + (i + 1);
								input.required = true;
								form_name.appendChild(input);
							break;
						case 4:
							input.type = "text";
							input.placeholder = "Reps";
							input.id = "reps" + (i + 1);
								input.name = "reps" + (i + 1);
								input.required = true;
								form_name.appendChild(input);
							break;
						case 5:
							var selectList = document.createElement("select");
							selectList.id = "select" + (i + 1);
							selectList.name = "select" + (i + 1);
							selectList.required = true;
							for (p = 0; p < selectListElements.length; p++){
								var option = document.createElement("option");
								option.value = selectListElements[p];
								option.text = selectListElements[p];
								if (p == 0) {
									option.selected = true;
								}
								selectList.appendChild(option);
								form_name.appendChild(selectList);

							}
							break;
						case 6:
							input.type = "text";
							input.placeholder = "Description"
							input.id = "description" + (i + 1);
							input.name = "description" + (i + 1);
							input.required = true;
							form_name.appendChild(input);
					}

				}

				 }

			}
//Temp AutoFill
function autofill(){
    var formName = document.getElementById('frm0');
    var formlength = formName.getElementsByTagName("input").length;

 for (i = 0; i <= 4; i++){


      for (j = 1; j <= formlength; j++){
    switch (i) {
      case 0:
        child = document.getElementById("group" + j);
        child.value = "A" + j;
        break;
      case 1:
        child = document.getElementById("lift" + j);
        child.value = "Test" + j;
        break;
      case 2:
        child = document.getElementById("percent" + j);
        child.value = "50,50,50,50,50";
        break;
      case 3:
        child = document.getElementById("sets" + j);
        child.value = 5;
        break;
      case 4:
        child = document.getElementById("reps" + j);
        child.value = "5,4,3,2,1";
        break;
    }
      }

  }


}



//Function Deletes Rows
function delete_row(){
  var formName = document.getElementById('frm0');
  var formlength = formName.getElementsByTagName("input").length;

  //If formlength is less or equal to 6 than alert
  if (formlength <= 1){
    alert("Bitch Ass Nigga! Can't Delete Anymore");
    return;
  }


  //Loop to Delete Row
  for (i = 0; i <= 6; i++){

    switch (i) {
      case 0:
        jQuery("#group" + formlength).remove();
        break;
      case 1:
        jQuery("#lift" + formlength).remove();
        break;
      case 2:
        jQuery("#percent" + formlength).remove();
        break;
      case 3:
        jQuery("#sets" + formlength).remove();
        break;
      case 4:
        jQuery("#reps" + formlength).remove();
        break;
			case 5:
				jQuery("#select" + formlength).remove();
				break;
			case 6:
				jQuery("#description" + formlength).remove();
				break;
    }

  }



}



//Function Adds Rows
function add_row(row) {
	var form = document.getElementById("frm0");
	var formlength = form.getElementsByTagName("input").length + 1;

    for (i = 0; i <= 6 ; i++){
    var form_data = document.getElementById("frm" + i);
    var input = document.createElement('input');

    //Switch Statement for Input Placeholder and Type
      switch (i){
        case 0:
          input.type = "text";
          input.placeholder = "Group";
          input.id = "group" + formlength;
          input.name = "group" + formlength;
					input.required = true;
					form_data.appendChild(input);
          break;
        case 1:
          input.type = "text";
          input.placeholder = "Lift";
          input.id = "lift" + formlength;
          input.name = "lift" + formlength;
					input.required = true;
					form_data.appendChild(input);
          break;
        case 2:
          input.type = "text";
          input.placeholder = "Percentage";
          input.id = "percent" + formlength;
          input.name = "percent" + formlength;
          input.required = true;
					form_data.appendChild(input);
          break;
        case 3:
          input.type = "number";
          input.placeholder = "Sets";
          input.id = "sets" + formlength;
          input.name = "sets" + formlength;
          input.required = true;
					form_data.appendChild(input);
          break;
        case 4:
          input.type = "text";
          input.placeholder = "Reps";
          input.id = "reps" + formlength;
          input.name = "reps" + formlength;
          input.required = true;
					form_data.appendChild(input);
          break;
				case 5:
						var selectListLength = document.getElementsByTagName("select").length-1;
						var selectList = document.createElement("select");
						selectList.id = "select" + formlength;
						selectList.name = "select" + formlength;

						for (p = 0; p < selectListElements.length; p++){
							var option = document.createElement("option");
							option.value = selectListElements[p];
							option.text = selectListElements[p];
							if (p == 0) {
								option.selected = true;
							}
							selectList.appendChild(option);
							form_data.appendChild(selectList);

						}
					break;
				case 6:
					input.type = "text";
					input.placeholder = "Description";
					input.id = "description" + formlength;
					input.name = "description" + formlength;
					input.required = true;
					form_data.appendChild(input);
      }

    }


  }
