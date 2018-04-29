<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
//
// Your code goes below
//


function get_data(){
	global $wpdb;

	$table = $wpdb->prefix . "program_table";

//get_results for the whole table
	$result = $wpdb->get_results("SELECT * FROM $table");

//Store the variables to a two dm array
	foreach($result as $item) {
		$liftunserial = unserialize($item->lift);
		$itemMain[] = array($item->id, $item->program, $item->week, $item->day, $liftunserial);
	}


//json_encode to send it to javascript
	if($result){
		echo json_encode($itemMain);

	}else{
		echo null;
	}

		wp_die();
}

add_action('wp_ajax_get_data', 'get_data');
add_action('wp_ajax_nopriv_get_data', 'get_data');



	function send_data(){
		global $wpdb;

		$table = $wpdb->prefix . "program_table";

//Create Table if it doesn't exist
		$charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`program` text NOT NULL,
		`week` text NOT NULL,
		`day` text NOT NULL,
        `lift` text NOT NULL,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

//Grab Value from AJax and put them into variables
				$weekVal = $_POST['weekVal'];
				$dayVal = $_POST['dayVal'];
				$liftArray = $_POST['liftArray'];
				$programVal = $_POST['programVal'];

//serialize liftarray (put it into a string) for easier storage
				$final = serialize($liftArray);

//Call Update Query
				$resultUpdate = $wpdb->update(
				$table,
					array(
						'lift' => $final
					),
					array(
							'week' =>  $weekVal,
							'day' => $dayVal,
							'program' => $programVal
						)
				);

//if update Query > 0 then it successfully update
				if($resultUpdate > 0) {
					echo "Successfully Updated $weekVal and $dayVal to $programVal in the database!";
				}else if ($resultUpdate === 0) {

//If update Query === 0 then the table is not in the database OR the user didn't update any variables

										$result = $wpdb->get_results("SELECT * FROM $table WHERE program = '$programVal' and week = '$weekVal' and day = '$dayVal'");

										if($result == null){
															$resultInsert = $wpdb->insert(
																		$table,
																		array(
																	'program' => $programVal,
																	'week' => $weekVal,
																	'day' => $dayVal,
																				'lift' => $final
																		)
																);

																			if ($resultInsert == false){
																				echo "Failed to Update or Create $weekVal and $dayVal to $programVal in the database!";
																			}else{
																			echo "Successfully inserted $weekVal and $dayVal to $programVal in the database!";
																		}

										}else{
														echo "User did not update any values. $weekVal and $dayVal  in $programVal remain unchanged!";
										}

//if update query is false it means that the query did not execute!
				}else if ($resultUpdate == false) {
					echo "Failed to Execute ERROR!";
				}else{
					echo "Failed to Execute ERROR!";
				}

						wp_die();

	}

	add_action('wp_ajax_send_data', 'send_data');
	add_action('wp_ajax_nopriv_send_data', 'send_data');


//Functions of Javascript Files Attached to pages
	function load_js_page_form_testing() {
		//program form page
    if( is_page( 284 ) ) {
        wp_enqueue_script('js_form_functions', get_stylesheet_directory_uri() . '/js/temp_functions.js');
				wp_enqueue_script('jQuery_form_functions', get_stylesheet_directory_uri() . '/js/jquery_form_functions.js', array( 'jquery' ), '1.0.0', true );
    }

		//page-display.php
		if(is_page( array(282, 280) ) ) {
			wp_enqueue_script('js_display_functions', get_stylesheet_directory_uri() . '/js/display_functions.js', array( 'jquery' ), '1.0.0');
			wp_enqueue_script('jQuery_form_functions', get_stylesheet_directory_uri() . '/js/jquery_form_functions.js', array( 'jquery' ), '1.0.0', true );
		}


}

add_action('wp_enqueue_scripts', 'load_js_page_form_testing');

//Transferred ajaxurl to front-end from backend
//Before it was only accessed in the backend of wordpress
function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

add_action('wp_head', 'myplugin_ajaxurl');