jQuery('#my-client-list').on('change', function() {

  if(this.value == "default"){

      jQuery("[name=client-info]").css('display', 'none');

 //clear profile-info
      jQuery("#profile-info").children().each(function(index) {

        switch (index) {
          case 0:
              jQuery(this).children().each(function(i) {

                var value = jQuery(this);
                value.html("");

                  switch (i) {
                    case 1:
                      value.attr('src', "");
                  }

              });
            break;
          case 1:
              jQuery(this).children().each(function(i) {

                var value = jQuery(this);
                value.html("");

              });

        }

      });

//clear profile-body
      jQuery("#profile-body").children().each(function(index) {

        switch (index) {
          case 0:
              jQuery(this).children().each(function(i) {

                var value = jQuery(this);
                value.html("");

              });
            break;
          case 1:
              jQuery(this).children().each(function(i) {

                var value = jQuery(this);

                switch (i) {
                  case 0:
                    value.html("");
                    break;
                  case 1:
                    value.css("display", "none");

                }

              });

            }

      });

    //Display Send Sessions
    jQuery("#add-sessions-form").css("display", "none");
    jQuery("#register-client").css("display", "none");


    return;

  }else{
      jQuery("[name=client-info]").css('display', 'initial');
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


function getAge(dateString)
{
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
    {
        age--;
    }
    return age;
}

function display_get_info(clientData){

  var url = window.location.protocol+"//"+window.location.host + "/main/";

  var img = url + clientData[5];

  var name = "<b>Name: </b>" + clientData[1] + " " + clientData[2];

  var height = "<b>Height: </b>" + clientData[6] + "'" + clientData[7] + '"';

  var description = create_elements("<b>Description: </b>", 11, clientData);
  var weight = create_elements("<b>Weight: </b>", 8, clientData);
  var birthday = create_elements("<b>Birthday: </b>", 4, clientData);

  //Still need to add these attributes
  var goal = create_elements("<b>Goal: </b>", 10, clientData);
  var purpose = create_elements("<b>Purpose: </b>", 9, clientData);
  var sessionAmount = create_elements("<b>Sessions Available: </b>", 12, clientData);
  var email = create_elements("<b>Email: </b>", 13, clientData);
  var phoneNumber = create_elements("<b>Phone Number: </b>", 14, clientData);

  jQuery("#profile-info").children().each(function(index) {

    switch (index) {
      case 0:
          jQuery(this).children().each(function(i) {

            var value = jQuery(this);
            value.html("");

              switch (i) {
                case 0:
                value.append("Client");
                break;
                case 1:
                  value.attr('src', img);
              }

          });
        break;
      case 1:
          jQuery(this).children().each(function(i) {

            var value = jQuery(this);
            value.html("");

              switch (i) {
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
                  birthday = getAge(birthday);
                  var str = "<b>Age: </b>" + birthday;
                  value.append(str);
              }

          });

    }





    // var value = jQuery(this);
    // value.html("");
    // switch(index){
    //   case 0:
    //     value.attr('src', img);
    //     break;
    //   case 1:
    //     value.append(name);
    //     break;
    //   case 2:
    //     value.append(height);
    //     break;
    //   case 3:
    //     value.append(weight);
    //     break;
    //   case 4:
    //     birthday = getAge(birthday);
    //     var str = "Age: " + birthday;
    //     value.append(str);
    //     break;
    //   case 5:
    //     value.append(description);
    //
    // }
  });

  jQuery('#profile-body').children().each(function(index) {

    switch (index) {
      case 0:
          jQuery(this).children().each(function(i) {

            var value = jQuery(this);
            value.html("");

              switch (i) {
                case 0:
                    value.append(description);
                  break;
                case 1:
                    value.append(purpose);
                  break;
                case 2:
                    value.append(goal);
                  break;
                case 3:
                    value.append(email);
                  break;
                case 4:
                    value.append(phoneNumber);
                  break;
              }

          });
        break;
      case 1:
          jQuery(this).children().each(function(i) {

            var value = jQuery(this);

              switch (i) {
                case 0:
                  value.html("");
                  value.append(sessionAmount);
                  break;
                }

          });

    }





      // var value = jQuery(this);
      // value.html("");
      // switch(index){
      //   case 0:
      //     value.append(goal);
      //     break;
      //   case 1:
      //     value.append(purpose);
      //     break;
      //   case 2:
      //     value.append(sessionAmount);
      //     break;
      //   case 3:
      //     value.append(email);
      //     break;
      //   case 4:
      //     value.append(phoneNumber);
      //
      // }
  });




    //Display Send Sessions
    jQuery("#add-sessions-form").css("display", "initial");
    jQuery("#register-client").css("display", "initial");

}

function create_elements(str, num, clientData){
  var client = clientData[num];
  return str + client;
}

//Start client reminder submit button Function
  jQuery( "#client-annoucement" ).submit(function( event ) {

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

  //Start client reminder submit button Function
    jQuery( "#add-sessions-form" ).submit(function( event ) {

      event.preventDefault();

      var session = jQuery("#add-sessions").val();
      var trainerUsername = jQuery("#trainer-username").val();
      var clientSelect = jQuery("#my-client-list").val();
      if(session.length === 0){
        alert("Please enter a number greater than 0");
        return;
      }

      jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: ({
              action: "update_client_sessions",
              session: session,
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

// function create_workout_table(){
//   var formName = document.getElementById('workout-form');
//
//   var tbl = document.createElement('table');
//   tbl.id = "workout-table";
//   tbl.name = "workout-table";
//   var tbdy = document.createElement('tbody');
//
//   //Every tr (row) has a name
//   //(Columns) Group, Lift, Percentage, Weight, Reps
//
//   for(i = 0; i < 6; i++){
//     var tr = document.createElement('tr');
//     tr.id = "row" + i;
//       for (j = 0; j < 7; j++){
//         if(i === 0){
//                 var th = document.createElement('th');
//                 switch(j){
//                   case 0:
//                     th.innerText = "Group";
//                     break;
//                   case 1:
//                     th.innerText = "Lift";
//                     break;
//                   case 2:
//                     th.innerText = "Percentage";
//                     break;
//                   case 3:
//                     th.innerText = "Weight";
//                     break;
//                   case 4:
//                     th.innerText = "Reps";
//                     break;
//                   case 5:
//                     th.innerText = "Type Input";
//                     break;
//                   case 6:
//                     th.innerText = "Input"
//                 }
//                 tr.appendChild(th);
//               }else if(i > 0 && j == 5){
//                     var td = document.createElement('td');
//                     var selectList = document.createElement('select');
//                     selectList.id = "i" + i + "j" + j;
//
//                     for(w = 0; w < 3; w++){
//                       var option = document.createElement('option');
//                       switch(w){
//                         case 0:
//                           option.innerText = "Text";
//                           option.value = "text";
//                           break;
//                         case 1:
//                           option.innerText = "Youtube";
//                           option.value = "youtube";
//                           break;
//                         case 2:
//                           option.innerText = "Image";
//                           option.value = "image";
//                       }
//                       selectList.append(option);
//                     }
//                     td.appendChild(selectList);
//                     tr.appendChild(td);
//               }else{
//                   var td = document.createElement('td');
//                   td.contentEditable = "true";
//                   td.id = "i" + i + "j" + j;
//                   tr.appendChild(td);
//               }
//       }
//     tbdy.appendChild(tr);
//   }
//
//   tbl.appendChild(tbdy)
//
//   var input = document.createElement('input');
//   input.type = "submit";
//   input.name = "work-submit";
//   input.id = "work-submit";
//
//   formName.appendChild(tbl);
//   formName.appendChild(input);
//
// }
//
//
//
// function create_label(val, text, div){
//   var label = document.createElement('label');
//   label.htmlFor = val;
//   label.innerText = text;
//   div.appendChild(label);
// }
//
//
//   jQuery( "#workout-form" ).submit(function( event ) {
//         event.preventDefault();
//
//         //array to store workout
//         var workoutArray = [];
//
//     jQuery('#workout-table tr').each(function(i,v){
//
//       //Create an array for each array
//           workoutArray[i] = Array();
//
//           jQuery(this).children('td').each(function(j,vv) {
//             var val = jQuery(this).text();
//
//             //Store the value in the area that is created previously
//             workoutArray[i][j] = val;
//
//           });
//
//     });
//
// console.log(workoutArray);
//
//
//   });
//
//   jQuery("#displayBtn").on('click', function() {
//     alert("hello");
//   });
//
//   jQuery('#workout-form').on('change', '#workout-table select', function() {
//     var that = jQuery(this),
//         id = that.attr('id'),
//         value = that.val();
//
//         id = id.substring(0, id.length - 1);
//         id = id + 6;
//
//         var td = document.getElementById(id);
//
//         if(value == "image"){
//           var input = document.createElement('input');
//           input.type = "file";
//           input.id = id;
//           td.appendChild(input);
//         }else{
//           td.innerHTML = "";
//         }
//
//   });
//
//   jQuery('#workout-form').on('change', '#workout-table input:file', function(e) {
//     var that = jQuery(this),
//         id = that.attr('id');
//
//         var trainerUsername = jQuery("#trainer-username").val();
//         var month = jQuery("#input-month").val();
//
//         if (month === ""){
//           alert("Please indicate month before uploading image.");
//           jQuery(this).append("");
//           return;
//         }
//
//         var week = jQuery("#select-week").val();
//         var day = jQuery("#select-day").val();
//
//         var imageName = trainerUsername + '-' + month + '-' + week + "-" + day + '-' + id;
//
//     var fd = new FormData();
//      var file = jQuery(this);
//      var individual_file = file[0].files[0];
//      fd.append("file", individual_file);
//      fd.append('action', 'store_workout_image');
//      fd.append('trainerUsername', trainerUsername);
//      fd.append('imageName', imageName);
//
//         jQuery.ajax({
//               type: "POST",
//               url: ajaxurl,
//               data: fd,
//               contentType: false,
//               processData: false,
//               success: function (data){
//                 if(data == 0){
//                   alert("Whoops, something went wrong.");
//                 }else if(data == 1){
//                   alert("I apologize, but your image is too big. Please less than 100000000 bytes.");
//                 }else if(data == 2){
//                   alert("Please only jpg, jpeg, png, and pdf.");
//                 }else{
//                   var p = document.createElement('p');
//                   p.innerHTML = data;
//                   p.hidden = true;
//                   jQuery("#" + id).append(p);
//                   jQuery("#" + id).append(img);
//
//                 }
//               }
//               });
//
//   });
