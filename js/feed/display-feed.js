jQuery(document).ready(function(jQuery) {

    //Call Ajax To send Data

    jQuery.ajax({
    			type: "POST",
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
            alert("Looks like we are having issues right now. Thank " +
            "you for you patience.");
            console.log(data);
          }
    		});



});




function display_content_feed(contentData){

  if(contentData == null){
    alert("Looks like we are having trouble accessing the videos and images.");
  }

  //Strategy
  //Check if its a video or a img

  console.log(contentData);

  var domainUrl = window.location.protocol+"//"+window.location.host + "/main/";

  for(var i = 0; i < contentData.length; i++){
    var athleteContent = document.querySelector('#athlete-content');
    var contentUrl = contentData[i][0];
    var contentType = contentData[i][1];
    var contentDescription = contentData[i][2];
    var contentDate = contentData[i][3];
    if(contentType == 'image'){
      var contentItem = document.createElement("img");
      contentItem.setAttribute('src', domainUrl + contentData[i][0]);
    }else if(contentType == 'video'){
      var contentItem = document.createElement("iframe");
      contentItem.setAttribute('src', contentData[i][0]);
    }else{
      console.log('Error Loading ' + contentUrl);
      return;
    }

    athleteContent.append(contentItem);
  }


}
