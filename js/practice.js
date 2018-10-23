var selectListElements = ["none", "back squat", "hang clean", "power clean", "snatch", "front squat", "bench"];

function populateTable(){

      var formDisplay = document.getElementById("form-display");

      var tbl = document.createElement('table');
      tbl.setAttribute("class", "programTable");
      var tbdy = document.createElement('tbody');
      for (var i = 0; i < 5; i++) {
        var tr = document.createElement('tr');
          tr.setAttribute("id", "row" + i);
            for (var j = 0; j < 6; j++) {
              var td = document.createElement('td');
              td.contentEditable = 'true';


              if (i == 0){
                populateTableTitle(j, td, tr);
              }else{
                    switch(j){
                      case 0:
                                var text = document.createTextNode('A');
                                td.appendChild(text);
                            break;
                      case 1:
                                var text = document.createTextNode('B');
                                td.appendChild(text);
                            break;
                      case 2:
                                var text = document.createTextNode('C');
                                td.appendChild(text);
                            break;
                      case 3:
                                        var selectList = document.createElement("select");
                                        // selectList.id = itemMainName;
                                        // selectList.name = itemMainName;
                                        selectList.required = true;

                                        for (p = 0; p < selectListElements.length; p++){
                                              var option = document.createElement("option");
                                              option.value = selectListElements[p];
                                              option.text = selectListElements[p];
                                              selectList.appendChild(option);
                                        }
                                    td.contentEditable = 'false';
                                    td.appendChild(selectList);
                            break;
                        case 4:
                                var text = document.createTextNode('E');
                                td.appendChild(text);
                            break;
                        case 5:
                                var text = document.createTextNode('F');
                                td.appendChild(text);
                            break;
                      }

                tr.appendChild(td);
              }

          }

        tbdy.appendChild(tr);
    }
    tbl.appendChild(tbdy);
    formDisplay.appendChild(tbl);

}

function populateTableTitle(index, td, tr){

  td.contentEditable = 'false';

  switch(index){
    case 0:
      var text = document.createTextNode('Group');
      td.appendChild(text);
    break;
    case 1:
    var text = document.createTextNode('Lift');
    td.appendChild(text);
  break;
    case 2:
    var text = document.createTextNode('Percent');
    td.appendChild(text);
  break;
    case 3:
    var text = document.createTextNode('Max');
    td.appendChild(text);
  break;
    case 4:
    var text = document.createTextNode('Reps');
    td.appendChild(text);
  break;
    case 5:
    var text = document.createTextNode('Description');
    td.appendChild(text);
  break;
  }

  tr.appendChild(td);

}
