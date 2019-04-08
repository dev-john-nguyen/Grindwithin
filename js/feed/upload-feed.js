jQuery("#content-form-image").submit(function(e){
  e.preventDefault();

  var description = jQuery('#descriptionImage').val();

    var fd = new FormData();
     var file = jQuery('#content-form-image input:file');
     var individual_file = file[0].files[0];
     fd.append("file", individual_file);
     fd.append('action', 'store_image_content_feed');
     fd.append('description', 'description');

     console.log(file);

        jQuery.ajax({
              type: "POST",
              url: ajaxurl,
              data: fd,
              contentType: false,
              processData: false,
              success: function (data){
                if(data == 0){
                  alert("Whoops, something went wrong.");
                }else if(data == 1){
                  alert("I apologize, but your image is too big. Please less than 100000000 bytes.");
                }else if(data == 2){
                  alert("Please only jpg, jpeg, png, and pdf.");
                }else{
                  alert(data);
                }
              }
              });

});

jQuery('#content-form-video').submit(function(e){
  e.preventDefault();

  var youtubeURL = jQuery('#youtubeUrl').val();
  var description = jQuery('#descriptionVideo').val();

  console.log(youtubeURL, description);


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
