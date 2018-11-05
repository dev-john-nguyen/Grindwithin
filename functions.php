<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//
function my_theme_enqueue_styles() {

    $parent_style = 'Tesseract-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/css/site-banner.css' );

}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles');
//
// Your code goes below
//





function image_crop($url, $name){

      $image = wp_get_image_editor( $url );

    if ( ! is_wp_error( $image ) ) {

      $image->resize( 150, 150, true );

      $data = $image->save($url);

    }

    if( ! is_wp_error( $data )  )
    {

        return "updated";

    }else{

        return "image-crop-error";

    }

}


function get_member_profile(){
  global $wpdb;

  $table = $wpdb->prefix . "profile";

  $username = $_SESSION['member'];

  $sql = $wpdb->prepare("SELECT t.birthday, t.imagePath, t.heightFeet, t.heightInch, t.weight,
      t.purpose, t.description FROM $table t Where t.username = %s", array($username));
  $result = $wpdb->get_results($sql);

  return $result;

  wp_die();

}

if(isset($_POST['submit-member-settings'])){

  if(empty($_FILES['file-member'])){
    header("Location: ?empty");
    exit();
  }


  $file = $_FILES['file-member'];
  $fileName = $_FILES['file-member']['name'];
  $fileTmpName = $_FILES['file-member']['tmp_name'];
  $fileSize = $_FILES['file-member']['size'];
  $fileError = $_FILES['file-member']['error'];
  $fileType = $_FILES['file-member']['type'];
  // $fileName = $_POST['member'];

  $fileExt = explode('.', $fileName);

  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf');

  if(in_array($fileActualExt, $allowed)){
    if ($fileError === 0){
      if($fileSize < 100000000){
        $base = wp_upload_dir();
        $basedir = $base['basedir'];
        $fileDestination = $basedir . '/' . $fileName;
        $fileDestinationStore = 'wp-content/uploads/' . $fileName;
          if (move_uploaded_file($fileTmpName, $fileDestination)){
            //Successfully moved to file destination

            $result = update_to_profile($fileDestinationStore);

            if($result === false){
              //If the query fails
              header("Location: ?failed-update");
              exit();
            }elseif(!$result){
              //No changes were made but still updated
              $imageCResults = image_crop($fileDestination, $fileName);
              header("Location: ?$imageCResults");
              exit();
            }else if($result > 1){
                  //email myself to notify that there are multiple users with the same username
                  header("Location: ?Duplicates");
                  exit();
            }else{
              //Changes were made and updated
                  $imageCResults = image_crop($fileDestination, $fileName);
                  header("Location: ?$imageCResults");
                  exit();
            }

          }else{
            //Unable to move the image to the file folder
            $message = "I apologize, but we are having issues uploading your picture.";
                header("Location: ?failed-04");
                exit();
          }

      }else{
        //Size is too big
        $message = "I apologize, but your image is too big. Please less than 100000000 bytes.";
        header("Location: ?failed-03");
        exit();
      }

    }else{
      //There is something wrong with the image itself
      $message = "Whoops, something went wrong.";
        header("Location: ?failed-02");
        exit();
    }

  }else{
    //Error not a qualified image
    $message = "Please only jpg, jpeg, png, and pdf.";
        header("Location: ?failed-01");
        exit();
  }


}

function check_settings_input($item){
  //   echo '<script type="text/javascript">',
  // 'if ( window.history.replaceState ) {',
  // 'window.history.replaceState( null, null, window.location.href );}',
  // '</script>';
  // sleep(1);

  foreach($item as $itemPos){
    if(!isset($_POST[$itemPos]) || empty($_POST[$itemPos])) {
        header("Location: ?empty");
        exit();
    }
  }


}

function update_to_profile($fileDestination){
  global $wpdb;

  $table = $wpdb->prefix . "profile";

  //Create Table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
      `username` text NOT NULL,
      `birthday` date,
      `imagePath` text,
      `heightFeet` int,
      `heightInch` int,
      `weight` int,
      `purpose` text,
      `goal` text NOT NULL,
      `description` text,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $imagePath = $fileDestination;
    $username = $_POST['member'];
    $birthday = $_POST['birthday'];
    $heightFeet = $_POST['height-feet'];
    $heightInch = $_POST['height-inch'];
    $weight = $_POST['weight'];
    $purpose = $_POST['purpose'];
    $goal = $_POST['goal'];
    $description = $_POST['description'];



  $result =  $wpdb->update(
    $table,
      array(
        'birthday' => $birthday,
        'heightFeet' => $heightFeet,
        'heightInch' => $heightInch,
        'weight' => $weight,
        'purpose' => $purpose,
        'goal' => $goal,
        'description' => $description,
        'imagePath' => $imagePath
      ),
      array(
        'username' => $username
        )
    );

      return $result;
      wp_die();

}


function logout_user(){

  session_start();
  unset($_SESSION['member']);
  unset($_SESSION['firstName']);
  unset($_SESSION['lastName']);
  unset($_SESSION['goal']);
  session_destroy();

}
add_action('wp_ajax_logout_user', 'logout_user');
add_action('wp_ajax_nopriv_logout_user', 'logout_user');


function authenticate_user(){
global $wpdb;

$username = esc_sql($_POST['username']);
$password = esc_sql($_POST['password']);

$table = $wpdb->prefix . "bitches2";

$sql = $wpdb->prepare("SELECT t.username, t.damn, t.type FROM $table t Where t.username = %s", array($username));
$result = $wpdb->get_results($sql);

if(empty($result)){
  echo "Incorrect username or password. Please try again.";
}else{
  foreach($result as $item){
    $password_hashed = $item->damn;
    $usernameSes = $item->username;
    $type = $item->type;

    //$password_hashed = apply_filters( 'salt', $password_hashed, 'bitch ass nigga!');
      if($type == "customer"){
          if(wp_check_password($password, $password_hashed)){
            session_start();
            $_SESSION['member'] = $usernameSes;
            echo 1;
          }else{
            echo "Incorrect username or password. Please try again.";
          }
      }else if ($type == "trainer"){
          if(wp_check_password($password, $password_hashed)){
            session_start();
            $_SESSION['member'] = $usernameSes;
            echo 1;
          }else{
            echo "Incorrect username or password. Please try again1.";
          }
      }else{
        echo "I apologize, we are having problems accessing your information. Please contact us directly.";
      }

    }

  }


wp_die();
}
add_action('wp_ajax_authenticate_user', 'authenticate_user');
add_action('wp_ajax_nopriv_authenticate_user', 'authenticate_user');

function store_new_profile($fName, $lName, $username, $goal){

  global $wpdb;

  $table = $wpdb->prefix . "profile";

  //Create Table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `username` text NOT NULL,
    `birthday` date,
    `imagePath` text,
    `heightFeet` int,
    `heightInch` int,
    `weight` int,
    `purpose` text,
    `goal` text NOT NULL,
    `description` text,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $result = $wpdb->insert(
          $table,
          array(
        'username' => $username,
        'goal' => $goal
          )
      );

      return $result;

wp_die();
}

function store_new_account(){
  global $wpdb;

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $goal = $_POST['goal'];

  $table = $wpdb->prefix . "bitches2";

  //validate input
  if (preg_match('/[^A-Za-z0-9.#\\-$]/', $fName) || preg_match('/[^A-Za-z0-9.#\\-$]/', $lName)){
    exit("Please enter valid characters for First Name and Last Name");
  }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Invalid email format");
}

  //check if username exist

  	$result = $wpdb->get_results("SELECT t.username FROM $table t Where t.username = '$username'");

    if(!empty($result)){
      exit("Username is already taken. Please try again.");
    }

//Create Table if it doesn't exist
  $charset_collate = $wpdb->get_charset_collate();
  $sql = "CREATE TABLE IF NOT EXISTS $table (
      `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `fName` text NOT NULL,
  `lName` text NOT NULL,
  `type` text NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `damn` text NOT NULL,
  `goal` text NOT NULL,
  UNIQUE (`id`)
  ) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );


$hashPass = wp_hash_password( $password );
// $salt = wp_salt($hashPass);
//
// $hashPass = $salt;

$type = "customer";

$result = $wpdb->insert(
      $table,
      array(
    'fName' => $fName,
    'lName' => $lName,
    'type' => $type,
    'email' => $email,
    'username' => $username,
    'damn' => $hashPass,
    'goal' => $goal
      )
  );

  if(!$result > 0 || !$result){
    echo "I apologize, we are having issues submitting your information. Please contact us directly via email." .
    "Thank you for your understanding.";
  }else{
    //create profile
    store_new_profile($fName, $lName, $username, $goal);
    //create workout


    session_start();
    $_SESSION['member'] = $username;
    echo 1;
  }

wp_die();

}
add_action('wp_ajax_store_new_account', 'store_new_account');
add_action('wp_ajax_nopriv_store_new_account', 'store_new_account');


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

																			if ($resultInsert === false){
																				echo "Failed to Update or Create $weekVal and $dayVal to $programVal in the database!";
																			}else{
																			echo "Successfully inserted $weekVal and $dayVal to $programVal in the database!";
																		}

										}else{
														echo "User did not update any values. $weekVal and $dayVal  in $programVal remain unchanged!";
										}

//if update query is false it means that the query did not execute!
      }else if ($resultUpdate === false) {
					echo "Failed to Execute ERROR!";
				}else{
					echo "Failed to Execute ERROR!";
				}

						wp_die();

	}

	add_action('wp_ajax_send_data', 'send_data');
	add_action('wp_ajax_nopriv_send_data', 'send_data');

//Javascript Files Attached to all Pages

  //Header Login Authentication
  wp_enqueue_script('js_header_login', get_stylesheet_directory_uri() . '/js/header_login.js', array( 'jquery' ), '1.0.0', true );



//Functions of Javascript Files Attached to pages
	function load_js_page_form_testing() {

    //trainer-settings.php and member-settings.php
    if (is_page('settings')){
        wp_enqueue_script('js_members_settings', get_stylesheet_directory_uri() . '/js/members/settings.js', array( 'jquery' ), '1.0.0', true );
    }

    //create.php
    if (is_page(874)){
      wp_enqueue_script('js_new_account', get_stylesheet_directory_uri() . '/js/create/new_account.js', array( 'jquery' ), '1.0.0', true );
    }

		//program form page
    if( is_page( 284 ) ) {
        wp_enqueue_script('js_form_functions', get_stylesheet_directory_uri() . '/js/temp_functions.js');
				wp_enqueue_script('jQuery_form_functions', get_stylesheet_directory_uri() . '/js/jquery_form_functions.js', array( 'jquery' ), '1.0.0', true );
    }

		//page-display.php
		if(is_page( array(282, 728) ) ) {
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
