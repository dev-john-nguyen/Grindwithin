jQuery('.applicant-list').on('change', function() {

  if(this.value == "default"){

      jQuery("[name=applicant-info]").css('display', 'none');

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
      jQuery("[name=applicant-info]").css('display', 'initial');
  }

  var applicantEmail = this.value;

  jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        async: false,
        data: ({
          action: "get_applicant",
          applicantEmail: applicantEmail
        }),
        dataType: "json",
        success: function (data){
              if(!data){
                alert("I apologize. We are having issues accessing clients information.");
              }else{
              display_info(data);
              }
          }
        });

});

function display_info(appData){

  var name = "<b>Name:</b><br>" + appData[0] + " " + appData[1];
  var email = "<b>Email:</b><br>" + appData[2];
  var certified = appData[3];

  if(certified == 1){
    certified = "<b>Certification:</b><br>" + appData[4];
  }else{
    certified = "<b>Certification:</b><br>" + "Not Certified";
  }

  var yearsExp = "<b>Years of Experience:</b><br>" + appData[5];
  var sportName = "<b>Sport:</b><br>" + appData[6];
  var sportLvl = "<b>Highest Level Competed:</b><br>" + appData[7];
  var q1 = "<b>Question 1:</b><br>" + appData[8];
  var q2 = "<b>Question 2:</b><br>" + appData[9];
  var q3 = "<b>Question 3:</b><br>" + appData[10];


  jQuery("#profile-info").children().each(function(index) {

          jQuery(this).children().each(function(i) {

            var value = jQuery(this);
            value.html("");

              switch (i) {
                case 0:
                  value.append(name);
                  break;
                case 1:
                  value.append(email);
                  break;
                case 2:
                  value.append(certified);
                  break;
                case 3:
                  value.append(yearsExp);
              }

          });
      });

      jQuery("#profile-body").children().each(function(index) {

              jQuery(this).children().each(function(i) {

                var value = jQuery(this);
                value.html("");

                  switch (i) {
                    case 0:
                      value.append(sportName);
                      break;
                    case 1:
                      value.append(sportLvl);
                      break;
                    case 2:
                      value.append(q1);
                      break;
                    case 3:
                      value.append(q2);
                      break;
                    case 4:
                      value.append(q3);
                  }

              });

          });


          document.querySelector("[name=trainer-app-email]").id = appData[2];

}
