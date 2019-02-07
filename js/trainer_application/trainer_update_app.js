jQuery("#update-trainer-app input").click(function(e){

    var idClicked = e.target.id;

    var trainerEmail = document.querySelector("[name=trainer-app-email]").id;

    jQuery.ajax({
          type: "POST",
          url: ajaxurl,
          data: ({
            action: "update_trainer_app",
            idClicked: idClicked,
            trainerEmail: trainerEmail
          }),
          success: function (response){
            alert(response);
            location.reload();
          }
        });

});
