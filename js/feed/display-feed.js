window.onload = function(){
  retrieve_content_feed();
};


function retrieve_content_feed(){

  //Call Ajax To send Data

  jQuery.ajax({
  			type: "GET",
  			url: ajaxurl,
  			async: false,
  			data: ({
  				action: "get_content_feed",
  			}),
  			dataType: "json",
  			success: function (data){
  				display_content_feed(data);
  			},
        error: function (data) {
          alert("Failed");
        }
  		});


}

function display_content_feed(contentData){

  console.log(contentData[0]);

  // if(Array.isArray(contentData)){
  // }


}
