jQuery("#arrowDownBtn").click(function(e) {

  jQuery("html, body").animate({ scrollTop: jQuery('.container').position().top }, "slow");

});
