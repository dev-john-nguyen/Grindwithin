jQuery(document).ready(function(jQuery) {

      jQuery('#display').click(function(event) {
        event.preventDefault();
    });



	jQuery( "#practice_form" ).submit(function( event ) {

    event.preventDefault();

    var liftArray = [];

    jQuery('.programTable td').each(function(index){
      var that = jQuery(this),
          name = that.attr('name'),
          value = that.text();

          var selectObject = that.find("select");
          if (selectObject.val()){
            var selCntry = selectObject.val();
            console.log(selCntry);
          }

          //liftArray[index] = [value];

          //console.log(value);

    });

    //console.log(liftArray);


  });


});
