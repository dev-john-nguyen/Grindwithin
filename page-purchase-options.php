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

<div class = "purchase-options-div">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "per-session" method = "post" >
      <h1>$40/session</h1>
      <h2>Buy as many as you would like</h2>
      <input type = "text" name = "purchase-option-text" value = "Single Sessions" hidden readonly/>
      <label for = "purchase-option-amount">Choose Desired Amount<br>Recommend buying package if purchasing more than 9</label>
      <input type = "number" id = "purchase-option-amount" name = "purchase-option-amount" value = "1" min = "1"/>
      <input type = "number" name = "purchase-option-price" value = "40" hidden readonly/>
				<input type = "submit" name = "submit" id = "submit-per-session"/>
    </form>
</div>

<div class = "purchase-options-div">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "week-subscription" method = "post" >
      <h1>Purchase 10 Session Package</h1>
      <h2>Originally $400 ($40/Session) Now $380 ($38/Session)</h2>
      <h2>Save $20 Dollars</h2>
            <input type = "text" name = "purchase-option-text" value = "Sessions Package" hidden readonly/>
            <input type = "number" name = "purchase-option-amount" value = "10" hidden readonly/>
            <input type = "number" name = "purchase-option-price" value = "38" hidden readonly/>
				<input type = "submit" name = "submit" id = "submit-week-subscription"/>
    </form>
</div>

<div class = "purchase-options-div">
    <form action="<?php echo site_url('pay'); ?>" class = "purchase-options" id = "month-subscription" method = "post" >
      <h1>Purchase 20 Session Package</h1>
      <h2>Originally $800 ($40/Session) Now $700 ($35/Session)</h2>
      <h2>Save $100 Dollars</h2>
            <input type = "text" name = "purchase-option-text" value = "Sessions Package" hidden readonly/>
            <input type = "number" name = "purchase-option-amount" value = "20" hidden readonly/>
            <input type = "number" name = "purchase-option-price" value = "35" hidden readonly/>
				<input type = "submit" name = "submit" id = "submit-month-subscription"/>
    </form>
</div>

  </div>



<?php get_footer('custes'); ?>
