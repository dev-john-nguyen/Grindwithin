jQuery('#my-client-list').on('change', function() {

  if(this.value == "default"){
    return;
  }

  var clientUsername = this.value;

  jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        async: false,
        data: ({
          action: "get_client_profile",
          clientUsername: clientUsername
        }),
        dataType: "json",
        success: function (data){
              if(!data){
                alert("I apologize. We are having issues accessing clients information.");
              }else{
              display_get_info(data);
              }
          }
        });

});

function display_get_info(clientData){
  console.log(clientData);

  var url = window.location.protocol+"//"+window.location.host + "/main/";

  var img = url + clientData[5];

  var name = "Name: " + clientData[1] + " " + clientData[2];

  var height = "Height: " + clientData[6] + "'" + clientData[7] + '"';

  var description = create_elements("Description", 11, clientData);
  var weight = create_elements("Weight", 8, clientData);
  var birthday = create_elements("Birthday", 4, clientData);

  //Still need to add these attributes
  var goal = create_elements("Goal", 10, clientData);
  var purpose = create_elements("Purpose", 9, clientData);

  jQuery("#profile-info").children().each(function(index) {
    var value = jQuery(this);
    value.html("");
    switch(index){
      case 0:
        value.append(name);
        break;
      case 1:
        value.append(height);
        break;
      case 2:
        value.append(weight);
        break;
      case 3:
        value.append(birthday);
        break;
      case 4:
        value.attr('src', img);
        break;
      case 5:
        value.append(description);

    }
  });

  jQuery('#client-header').children().each(function(index) {
      var value = jQuery(this);
      value.html("");
      switch(index){
        case 0:
          value.append(goal);
          break;
        case 1:
          value.append(purpose);
      }
  });


  // var reminderForm = document.createElement("form");
  // var input = document.createElement('input');
  //
  // reminderForm.name = "client-reminder";
  // reminderForm.id = "client-reminder";
  // reminderForm.method = "post";
  //
  // input.name = "trainer-username";
  // input.id = "trainer-username";


  //Create workout table
    create_workout_table();

}

function create_elements(str, num, clientData){
  var client = clientData[num];
  return str + ": " + client;
}

function create_workout_table(){
  var formName = document.getElementById('workout-form');

  var tbl = document.createElement('table');
  tbl.id = "workout-table";
  tbl.name = "workout-table";
  var tbdy = document.createElement('tbody');

  //Every tr (row) has a name
  //(Columns) Group, Lift, Percentage, Weight, Reps

  for(i = 0; i < 6; i++){
    var tr = document.createElement('tr');
    tr.id = "row" + i;
      for (j = 0; j < 5; j++){
        if(i === 0){
                var th = document.createElement('th');
                switch(j){
                  case 0:
                    th.innerText = "Group";
                    break;
                  case 1:
                    th.innerText = "Lift";
                    break;
                  case 2:
                    th.innerText = "Percentage";
                    break;
                  case 3:
                    th.innerText = "Weight";
                    break;
                  case 4:
                    th.innerText = "Reps";
                    break;
                  case 5:
                    th.innerText = "Description";
                }
                tr.appendChild(th);
              }else{
                  var td = document.createElement('td');
                  td.contentEditable = "true";
                  switch(i){
                    case 1:
                      td.innerText = "A";
                      break;
                    case 2:
                      td.innerText = "B";
                      break;
                    case 3:
                      td.innerText = "C";
                      break;
                    case 4:
                      td.innerText = "D";
                      break;
                    case 5:
                      td.innerText = "F";
                  }
                    tr.appendChild(td);
              }
      }
    tbdy.appendChild(tr);
  }

  tbl.appendChild(tbdy)

  var input = document.createElement('input');
  input.type = "submit";
  input.name = "work-submit";
  input.id = "work-submit";

  formName.appendChild(tbl);
  formName.appendChild(input);

}

//Start Submit Function
  jQuery( "#client-reminder" ).submit(function( event ) {

    event.preventDefault();

    var reminder = jQuery("#reminder-input").val();
    var trainerUsername = jQuery("#trainer-username").val();
    var clientSelect = jQuery("#my-client-list").val();
    if(reminder.length === 0){
      alert("Can't submit an empty reminder!");
      return;
    }

    console.log(reminder, trainerUsername, clientSelect);

    return;

    jQuery.ajax({
          type: "POST",
          url: ajaxurl,
          data: ({
            action: "update_client_reminder",
            reminder: reminder,
            trainerUsername: trainerUsername,
            clientSelect: clientSelect
          }),
          success: function (response){
            alert(response);
            location.reload();
          }
        });



  });
  //End Submit function

  jQuery( "#workout-form" ).submit(function( event ) {
        event.preventDefault();

        //array to store workout
        var workoutArray = [];

    jQuery('#workout-table tr').each(function(i,v){

      //Create an array for each array
          workoutArray[i] = Array();

          jQuery(this).children('td').each(function(j,vv) {
            var val = jQuery(this).text();

            //Store the value in the area that is created previously
            workoutArray[i][j] = val;

          });

    });

console.log(workoutArray);


  });
