jQuery("#content-form-image").submit(function(e){
  e.preventDefault();

  var description = jQuery('#descriptionImage').val();

  if(description.length == 0){
    alert("Please include a description for the file");
    return;
  }

    var fd = new FormData();
     var file = jQuery('#content-form-image input:file');
     var individual_file = file[0].files[0];
     console.log(individual_file.name+'|'+individual_file.size+'|'+individual_file.type);

     //Check if the image is too large
     if(individual_file.size > 5000000){
       alert("The Image uploaded is too large. Image must be less than 5MB.");
     }

     fd.append("file", individual_file);
     fd.append('action', 'store_image_content_feed');
     fd.append('description', 'description');

        jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: fd,
              contentType: false,
              processData: false,
              success: function (data){
                if(data == 0){
                  alert("Whoops, It looks like we are having issues storing the file. Try a different picture.");
                }else if(data == 1){
                  alert("I apologize, but your image is too big. Please less than 5MB.");
                }else if(data == 2){
                  alert("Please only jpg, jpeg, png, and pdf.");
                }else if(data == 3){
                  alert("Whoops, It looks like there is an issue with the file.");
                }else{
                  alert(data);
                }
              },
              error: function(){
                alert("Whoops, unexpected error happened. Please try again or try a different image.");
              }
              });

});

jQuery('#content-form-video').submit(function(e){
  e.preventDefault();

  var youtubeURL = jQuery('#youtubeUrl').val();
  var description = jQuery('#descriptionVideo').val();

  console.log(youtubeURL, description);

  if(!youtubeURL.includes('embed')){
    alert("Make Sure Youtube URL is the Embedded URL!");
    return;
  }


  if(!youtubeURL.includes('youtube')){
    alert("Please submit a youtube URL");
    return;
  }

            //Call Ajax To send Data
          jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: ({
                action: "store_video_content_feed",
                youtubeURL: youtubeURL,
                description: description
              }),
              success: function (data){
                alert(data);
              }
            });

});
