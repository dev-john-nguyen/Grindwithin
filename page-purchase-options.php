<?php

/**

 * The template for displaying all pages.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 * @package Tesseract

 */



get_header();

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<div id="primary" class="content-area sidebar-left">

		<div id = "display-sessions" class="row align-items-center" style = "text-align: center; padding-bottom: 50px;">
			<div class="col align-items-center" id = "header-content-items">
					<h1 class = "page-header">Get Trained By The Best</h1>
					<h2>Purchase Sessions Below</h2>
				</div>

		</div>

		<div class = "container">

			<div class = "row align-items-end">

<div class = "col purchase-div" style = "text-align: center;">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "per-session" method = "post" >
      <h2>$40 Per Session</h2>
      <input type = "text" name = "purchase-option-text" value = "Single Sessions" hidden readonly/>
      <label for = "purchase-option-amount"><p>Choose Desired Amount</p></label>
      <input type = "number" id = "purchase-option-amount" name = "purchase-option-amount" value = "1" min = "1" style = "width: 20%;"/>
			<br>
      <input type = "number" name = "purchase-option-price" value = "40" hidden readonly/>
				<input type = "submit" name = "submit" value = "Purchase" id = "submit-per-session"/>
    </form>
</div>

<div class = "col purchase-div" style = "text-align: center;">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "week-subscription" method = "post" >
      <h2>10 Session Package</h2>
      <p>Originally $400, Now $380 (Save $20)</p>
            <input type = "text" name = "purchase-option-text" value = "Sessions Package" hidden readonly/>
            <input type = "number" name = "purchase-option-amount" value = "10" hidden readonly/>
            <input type = "number" name = "purchase-option-price" value = "38" hidden readonly/>
				<input type = "submit" name = "submit" value = "Purchase" id = "submit-week-subscription"/>
    </form>
</div>

<div class = "col purchase-div" style = "text-align: center;">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "month-subscription" method = "post" >
      <h2>20 Session Package</h2>
      <p>Originally $800, Now $700 (Save $100)</p>
            <input type = "text" name = "purchase-option-text" value = "Sessions Package" hidden readonly/>
            <input type = "number" name = "purchase-option-amount" value = "20" hidden readonly/>
            <input type = "number" name = "purchase-option-price" value = "35" hidden readonly/>
				<input type = "submit" name = "submit" value = "Purchase" id = "submit-month-subscription"/>
    </form>
</div>

</div>

</div>

  </div>



<?php get_footer('custes'); ?>
