var selectListElements = ["none", "back squat", "hang clean", "power clean", "snatch", "front squat", "bench"];
//All the inputs of the selectListElements associated with their value
var maxArray = new Array();
//Clone the itemMain array that contains all the information from mySql database
var itemMainClone = new Array();
//Start jQuery
jQuery(document).ready(function() {

//Creating input values in the form
  for (i = 1; i < selectListElements.length; i++){
    var input = document.createElement('input');
    input.name = selectListElements[i];
    input.type = "number";
    input.placeholder = selectListElements[i].toUpperCase() + " MAX";
    jQuery('.max_inputs').append(input);
  }
  //Creating header text
  var subTitle = document.createElement('h4');
  subTitle.style.color = "black";
  subTitle.innerHTML = "Fill the form to the best of your ability. " +
   "The form will calculate your weights associated with the lift. " +
   "The weight will default to 0 if the max is not filled. " +
   "Then use the drop down menus to select the day of the program. ";

  jQuery('.title_inputs').append(subTitle);




//fill the maxArray
//default value will be ""
  jQuery('.max_inputs').find('[name]').each(function(index, value){
    var that = jQuery(this),
        name = that.attr('name'),
        value = that.val();

        maxArray[index] = [name, value];

  });
//update table in real time
//function is called when a user adds a value to a input field
//take not of .on('input', ...)
  jQuery('.max_inputs').find('[name]').on('input', function(){
    var that = jQuery(this),
        name = that.attr('name'),
        value = that.val();

//Looping through maxArray to update value associated with the updated input
        for (i = 0; i < maxArray.length; i++){
          if (name == maxArray[i][0]){
            maxArray[i][1] = value;
          }
        }
//Call function if display table is NOT empty
        if (!jQuery('#display_table').is(':empty')){
          populateProgram(itemMainClone);
        }
  });
//End jQuery
});

//Start Javascript
function populateProgram(itemMain) {
var week = document.getElementById("select_week").value;
var day = document.getElementById("select_day").value;
var program = document.getElementById("program_name").value;
var position = "";
//grab the div to display table
var divName = document.getElementById("display_table");

//Cloning array for jQuery purposes of updating table in real time
itemMainClone = itemMain.slice(0);

jQuery("#display_table").empty();

//Determine What array by checking Week and Day

if(week == "select" && day == "select"){
  alert("Please Choose the week and day of the program!");
  return false;
}else if(week == "select"){
  alert("Please Choose the week of the program!");
  return false;
}else if(day == "select"){
  alert("Please Choose the day of the program!");
  return false;
}else if (program == "select"){
  alert("Please Choose the program!");
  submit_form.disabled = true;
  return false;
}



for(j = 0; j < itemMain.length; j++){
//Find the index of which the user selected week and day in the array
  if(itemMain[j][1] == program && itemMain[j][2] == week && itemMain[j][3] == day){
  position = j;
  }

}
//If there is not match then display error alert
if(position === ""){
  alert(week + " and " + day + " is unavailable right now. Thank you for your patience!");
  return false;
}

//Length of the lift array
var lengthArray = itemMain[position][4].length - 1
//creating array for all maxitems
var maxItems = new Array();
//count for maxItems array
var maxItemsCount = 0;
//Creating Input elements to calculate weight
for (i = 0; i <= lengthArray; i++){
  var currentMaxItemName = itemMain[position][4][i][0];
  var currentMaxItemValue = itemMain[position][4][i][1];
//find select elements and putting it into maxItems array
  if (currentMaxItemName.includes("select")){
    maxItems[maxItemsCount] = currentMaxItemValue;
    maxItemsCount++;
  }
}
//creating the maxItemsFinal that removes duplicates
var maxItemsFinal = new Array();
//Taking all of the maxItems and moving to maxItemsFinal removing duplicates
jQuery.each(maxItems, function(i, el){
    if(jQuery.inArray(el, maxItemsFinal) === -1) maxItemsFinal.push(el);
});

//Create table and style
var tbl = document.createElement('table');
tbl.style.width = '100%';
tbl.style.height = '100px'
tbl.setAttribute('border', '1');
var tbdy = document.createElement('tbody');

var selectName;
//For loop through the length of the array
for (var i = 0; i <= lengthArray; i++) {
  //creating row with tr
    var tr = document.createElement('tr');
  //giving row an attribute id
  if ( i == 0 ){
    tr.setAttribute("id", "title");
  }else {
    tr.setAttribute("id", itemMain[position][4][i-1][0]);
  }


    for (var j = 0; j < 5; j++) {
      switch (j){
        case 0:
        //if statement to enter in the title of the table
              if (i == 0){
                //creating a table cell and giving it a value
                //table row will append the child
                //the table with append the table
                var td = document.createElement('td');
                td.appendChild(document.createTextNode("Group"));
                tr.appendChild(td);
                tbdy.appendChild(tr);
              }else{
                //Loop through the whole array to find lifting values
                    for (y = 0; y <= lengthArray; y++){
                      var itemMainName = itemMain[position][4][y][0];
                      var itemMainValue = itemMain[position][4][y][1];
                      var groupIndex = "group" + i;
                      var selectIndex = "select" + i;
                      //Compare the current position value to the groupIndex to find needed current value
                      if(itemMainName == groupIndex){
                        var td = document.createElement('td');
                        td.appendChild(document.createTextNode(itemMainValue));
                        tr.appendChild(td);
                        tbdy.appendChild(tr);
                  //End if
                  }else if(itemMainName == selectIndex){
                    //declare selectName to name the weight elements in CASE 2
                    selectName = itemMainValue;
                  }
                  //End For Loop
                  }
              //End Else
                }

          break;
        case 1:
//if statement to enter in the title of the table
              if (i == 0){
                //creating a table cell and giving it a value
                //table row will append the child
                //the table with append the table
                var td = document.createElement('td');
                td.appendChild(document.createTextNode("Lift"));
                tr.appendChild(td);
                tbdy.appendChild(tr);
              }else{
                //Loop through the whole array to find lifting values
                    for (y = 0; y <= lengthArray; y++){
                      var itemMainName = itemMain[position][4][y][0];
                      var itemMainValue = itemMain[position][4][y][1];
                      var groupIndex = "lift" + i;
                      //Compare the current position value to the groupIndex to find needed current value
                      if(itemMainName == groupIndex){
                        var td = document.createElement('td');
                        td.appendChild(document.createTextNode(itemMainValue));
                        tr.appendChild(td);
                        tbdy.appendChild(tr);
                    //End if
                      }
                  //End For Loop
                  }
            //End Else
              }

          break;

        case 2:
//if statement to enter in the title of the table
                  if (i == 0){
                    //creating a table cell and giving it a value
                    //table row will append the child
                    //the table with append the table
                    var td = document.createElement('td');
                    td.appendChild(document.createTextNode("Percentage"));
                    tr.appendChild(td);
                    tbdy.appendChild(tr);
                  }else{
                  //Loop through the whole array to find lifting values
                    for (y = 0; y <= lengthArray; y++){
                      var itemMainName = itemMain[position][4][y][0];
                      var itemMainValue = itemMain[position][4][y][1];
                      var groupIndex = "percent" + i;
                      //Compare the current position value to the groupIndex to find needed current value
                      if(itemMainName == groupIndex){

                        //For loop through the array again to grab rep values
                        for (w = 0; w <= lengthArray; w++){
                          var itemMainName2 = itemMain[position][4][w][0];
                          var itemMainValue2 = itemMain[position][4][w][1];
                          var repIndex = "reps" + i;
                          //put the rep string into an array
                            if(itemMainName2 == repIndex){
                              var resultSplitRep = itemMainValue2.split(",");
                            }
                      //End for Loop
                        }

                        //Splitting percent string and putting it into resultSplitPercent Array
                            var resultSplitPercent = itemMainValue.split(",");
                            //Loop through the whole resultSplitPercent Array
                            for (u = 0; u < resultSplitPercent.length; u++){

                              //Calculate the weight value
                              //Default weight to null
                              var weightValue = 0;
                              var percentValue = resultSplitPercent[u];

                              //Calculating weight value
                              //maxArray is a global variable that contains the input values of the form
                                  for (e = 0; e < maxArray.length; e++){
                                    if(selectName == maxArray[e][0]){
                                          if (maxArray[e][1] == ""){
                                            weightValue = 0;
                                          }else{
                                            weightValue = maxArray[e][1] * (percentValue/100);
                                            weightValue = Math.ceil(weightValue);
                                          }
                                    }
                                  }

                              //Create rep cell
                              var repTd = document.createElement('td');
                              //Create lift cell
                              var percentTd = document.createElement('td');
                              percentTd.value = percentValue;
                              //Create weight cell
                              var weightTd = document.createElement('td');
                              //selectName is declared in Case 0 by collecting the initial group
                              weightTd.id = selectName;
                              //Taking the first percent value and positioning it in the original tr (row)
                              if (u == 0){
                                percentTd.appendChild(document.createTextNode(percentValue + "%"));
                                repTd.appendChild(document.createTextNode(resultSplitRep[u]));
                                weightTd.appendChild(document.createTextNode(weightValue));

                                tr.appendChild(percentTd);
                                tr.appendChild(weightTd);
                                tr.appendChild(repTd);
                                tbdy.appendChild(tr);

                              }else{
                                  //Creating another row with trPercent
                                        var trPercent = document.createElement('tr');
                                        for (w = 0; w < 2; w++){
                                          //Creating cells that contain null to allow the percent value to reach the right column
                                          var td = document.createElement('td');
                                          td.appendChild(document.createTextNode(""));
                                          trPercent.appendChild(td);
                                        }
                                        //One the right column is selected, display the percent values
                                        percentTd.appendChild(document.createTextNode(percentValue + "%"));
                                        repTd.appendChild(document.createTextNode(resultSplitRep[u]));
                                        weightTd.appendChild(document.createTextNode(weightValue));
                                        trPercent.appendChild(percentTd);
                                        trPercent.appendChild(weightTd);
                                        trPercent.appendChild(repTd);
                                        tbdy.appendChild(trPercent);
                                  //End Else
                                    }
                          //End for loop resultSplitPercent
                            }
                  //End if for itemMainName == groupIndex
                      }
                //End for loop through lengthArray
                  }
              //End Else
                }
          break;
        case 3:
//if statement to enter in the title of the table
                  if (i == 0){
                    //creating a table cell and giving it a value
                    //table row will append the child
                    //the table with append the table
                    var td = document.createElement('td');
                    td.appendChild(document.createTextNode("Weight"));
                    tr.appendChild(td);
                    tbdy.appendChild(tr);
                }
          break;
        case 4:
//if statement to enter in the title of the table
                  if (i == 0){
                    //creating a table cell and giving it a value
                    //table row will append the child
                    //the table with append the table
                    var td = document.createElement('td');
                    td.appendChild(document.createTextNode("Reps"));
                    tr.appendChild(td);
                    tbdy.appendChild(tr);
                  }
    //End Switch Statement
            }
      //End For Loop for Columns
        }
  //End For Loop For the lengthArray Lifts
    }

    tbl.insertRow()
  tbl.appendChild(tbdy);
  divName.appendChild(tbl);


return false;

}



function populateColumnTable(){

//End function
}
