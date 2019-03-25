jQuery( "#cancel-membership" ).submit(function( event ) {

  event.preventDefault();

  var clientSelect = jQuery("#my-client-list").val();

  if(clientSelect){
    if (!confirm("Are you sure you want to cancel " + clientSelect + " membership?")){
          return;
      }
  }else{

    clientSelect = jQuery("#member").val();
    if (!confirm("Are you sure you want to cancel " + clientSelect + " membership?")){
          return;
      }

  }

  jQuery.ajax({
        type: "POST",
        url: ajaxurl,
        data: ({
          action: "deactivate_client_account",
          clientSelect: clientSelect
        }),
        success: function (response){
          alert(response);
          location.reload();
        }
      });



});
