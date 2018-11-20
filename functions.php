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

function update_client_reminder(){

  // global $wpdb;
  //
  // $reminder = $_POST['reminder'];
  //   $trainerUsername = $_POST['trainerUsername'];
  //
  // $table = $wpdb->prefix . "clients";
  //
  //
  //   $result = $wpdb->update(
  //     $table,
  //     array('reminder' => $reminder),
  //     array('trainer' => $trainerUsername)
  //   );
  //
  //     if($result === false){
  //       exit("Failed to update your selection. Please contact customer service");
  //     }else if($result == 0){
  //       exit("It looks like someone has already taken the user. I apologize for the inconvenience");
  //     }else{
  //       echo "Annoucement successfully updated!";
  //     }
  //
  // wp_die();


}

// function store_workout_image(){
//
//   $trainerUsername = $_POST['trainerUsername'];
//   $imageName = $_POST['imageName'];
//
//     $file = $_FILES['file'];
//     $fileName = $_FILES['file']['name'];
//     $fileTmpName = $_FILES['file']['tmp_name'];
//     $fileSize = $_FILES['file']['size'];
//     $fileError = $_FILES['file']['error'];
//     $fileType = $_FILES['file']['type'];
//
//     $fileExt = explode('.', $fileName);
//
//     $fileActualExt = strtolower(end($fileExt));
//
//     $allowed = array('jpg','jpeg','png','pdf');
//
//     $fileNameStore = "workout/" . $imageName . ".jpg";
//
//     if(in_array($fileActualExt, $allowed)){
//       if ($fileError === 0){
//         if($fileSize < 100000000){
//           $base = wp_upload_dir();
//           $basedir = $base['basedir'];
//           $fileDestination = $basedir . '/' . $fileNameStore;
//           $fileDestinationStore = 'wp-content/uploads/' . $fileNameStore;
//             if (move_uploaded_file($fileTmpName, $fileDestination)){
//
//                 image_crop($fileDestination, $fileNameStore);
//
//                 exit($fileDestinationStore);
//
//             }else{
//               exit("0");
//             }
//
//         }else{
//           //Size is too big
//           exit("1");
//         }
//
//       }else{
//           exit("0");
//       }
//
//     }else{
//           exit("2");
//     }
//
//
// }
// add_action('wp_ajax_store_workout_image', 'store_workout_image');
// add_action('wp_ajax_nopriv_store_workout_image', 'store_workout_image');

function get_client_profile(){
  global $wpdb;

  $clientUsername = $_POST['clientUsername'];

$table = $wpdb->prefix . "clients";

  $sql = $wpdb->prepare("SELECT t.username, t.fName, t.lName, t.annoucement,
    t.birthday, t.imagePath, t.heightFeet, t.heightInch, t.weight, t.purpose, t.goal,
    t.description FROM $table t WHERE t.username = %s", array($clientUsername));
    $results = $wpdb->get_results($sql);

    $error = 0;

    if(empty($results)){
      exit($error);
    }else{
      foreach($results as $item){
        // $clientInfoArray[] = array($item->username, $item->fName, $item->lName, $item->annoucement,
        // $item->birthday, $item->imagePath, $item->heightFeet, $item->heightInch, $item->weight,
        // $item->purpose, $item->goal, $item->description);
          foreach($item as $i){
            $clientInfoArray[]  = $i;
          }

      }
       echo json_encode($clientInfoArray);
    }

    wp_die();
}
add_action('wp_ajax_get_client_profile', 'get_client_profile');
add_action('wp_ajax_nopriv_get_client_profile', 'get_client_profile');

function update_client_annoucement(){
  global $wpdb;

  $annoucement = $_POST['annoucement'];
    $trainerUsername = $_POST['trainerUsername'];

  $table = $wpdb->prefix . "clients";


    $result = $wpdb->update(
      $table,
      array('annoucement' => $annoucement),
      array('trainer' => $trainerUsername)
    );

      if($result === false){
        exit("Failed to update your selection. Please contact customer service");
      }else if($result == 0){
        exit("It looks like someone has already taken the user. I apologize for the inconvenience");
      }else{
        echo "Annoucement successfully updated!";
      }

  wp_die();
}
add_action('wp_ajax_update_client_annoucement', 'update_client_annoucement');
add_action('wp_ajax_nopriv_update_client_annoucement', 'update_client_annoucement');

function trainer_register_client(){
  global $wpdb;

  $clientArray = $_POST['clientArray'];
  $trainerUsername = $_POST['trainerUsername'];

  $table = $wpdb->prefix . "clients";

  foreach($clientArray as $item){

    $result = $wpdb->update(
      $table,
      array('trainer' => $trainerUsername),
      array('username' => $item)
    );

      if($result === false){
        exit("Failed to update your selection. Please contact customer service");
      }else if($result == 0){
        exit("It looks like someone has already taken the user. I apologize for the inconvenience");
      }else{
        $clientStr .= " " . $item . ",";
      }

  }

  echo "$clientStr have been registerd under $trainerUsername";

  wp_die();
}
add_action('wp_ajax_trainer_register_client', 'trainer_register_client');
add_action('wp_ajax_nopriv_trainer_register_client', 'trainer_register_client');


function GetAge($dob)
{
        $dob=explode("-",$dob);
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = date("Y");
        $age = $curYear - $dob[0];
        if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2]))
                $age--;
        return $age;

}


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

        return "error";

    }

}


function get_member_profile($tableType){
  global $wpdb;

  $table = $wpdb->prefix . $tableType . "s";

  $username = $_SESSION['member'];

  $sql = $wpdb->prepare("SELECT t.birthday, t.imagePath, t.heightFeet, t.heightInch, t.weight,
      t.purpose, t.description, t.goal, t.athleteType, t.email, t.phoneNumber FROM $table t Where t.username = %s", array($username));
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
  //check if file is empty
  if($fileSize == 0){
    $blankImage = false;
    $result = update_to_profile($blankImage);

    if($result === false){
      //If the query fails
      header("Location: ?failed-update");
      exit();
    }elseif($result > 1){
          //email myself to notify that there are multiple users with the same username
          header("Location: ?duplicates");
          exit();
    }else{
      //Changes were made and updated
          header("Location: ?updated");
          exit();
    }

  }
  $fileError = $_FILES['file-member']['error'];
  $fileType = $_FILES['file-member']['type'];
  $memberName = $_POST['member'];

  $fileExt = explode('.', $fileName);

  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg','jpeg','png','pdf');

  $fileNameStore = "profile/" . $memberName . ".jpg";

  if(in_array($fileActualExt, $allowed)){
    if ($fileError === 0){
      if($fileSize < 100000000){
        $base = wp_upload_dir();
        $basedir = $base['basedir'];
        $fileDestination = $basedir . '/' . $fileNameStore;
        $fileDestinationStore = 'wp-content/uploads/' . $fileNameStore;
          if (move_uploaded_file($fileTmpName, $fileDestination)){
            //Successfully moved to file destination

            $result = update_to_profile($fileDestinationStore);

            if($result === false){
              //If the query fails
              $message = "I apologize, but we had trouble resizing your image.";
              header("Location: ?failed-update");
              exit();
            }elseif(!$result){
              //No changes were made but still updated
              $imageCResults = image_crop($fileDestination, $fileNameStore);
              header("Location: ?$imageCResults");
              exit();
            }else if($result > 1){
                  //email myself to notify that there are multiple users with the same username
                  header("Location: ?Duplicates");
                  exit();
            }else{
              //Changes were made and updated
                  $imageCResults = image_crop($fileDestination, $fileNameStore);
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

function update_to_profile($fileDestination){
  global $wpdb;

  $tableType = $_POST['type'];

  $table = $wpdb->prefix . $tableType . "s";

    $imagePath = $fileDestination;
    $username = $_POST['member'];
    $birthday = $_POST['birthday'];
    $heightFeet = $_POST['height-feet'];
    $heightInch = $_POST['height-inch'];
    $weight = $_POST['weight'];
    $purpose = $_POST['purpose'];
    $goal = $_POST['goal'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $athleteType = $_POST['athleteType'];

if(!$imagePath){
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
        'athleteType' => $athleteType,
        'phoneNumber' => $phoneNumber,
        'email' => $email
      ),
      array(
        'username' => $username
        )
    );
}else{
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
  }

      return $result;
      wp_die();

}


function logout_user(){

  session_start();
  unset($_SESSION['member']);
  unset($_SESSION['firstName']);
  unset($_SESSION['lastName']);
  session_destroy();

}
add_action('wp_ajax_logout_user', 'logout_user');
add_action('wp_ajax_nopriv_logout_user', 'logout_user');


function authenticate_user(){
global $wpdb;

$username = esc_sql($_POST['username']);
$password = esc_sql($_POST['password']);

$table = $wpdb->prefix . "members";

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
          if(wp_check_password($password, $password_hashed)){
            session_start();
            $_SESSION['member'] = $usernameSes;
            $_SESSION['type'] = $type;
            echo 1;
          }else{
            echo "Incorrect username or password. Please try again.";
          }
      }

    }

wp_die();
}
add_action('wp_ajax_authenticate_user', 'authenticate_user');
add_action('wp_ajax_nopriv_authenticate_user', 'authenticate_user');

function store_new_profile($fName, $lName, $username, $description, $currentDate, $athleteType, $email){

  global $wpdb;

  $table = $wpdb->prefix . "clients";

  //default image
  $defaultImage = "wp-content/uploads/profile/default.png";

  //Create Table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `accountCreated` date,
    `username` text,
    `email` text,
    `fName` text,
    `lName` text,
    `phoneNumber` int,
    `trainer` text,
    `athleteType` text,
    `annoucement` text,
    `birthday` date,
    `imagePath` text,
    `heightFeet` int,
    `heightInch` int,
    `weight` int,
    `purpose` text,
    `goal` text,
    `description` text,
    `sessionAmount` int,
    `status` text,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    //General Annoucement For Customers
    $annoucement = "Don't Wish For It Work For It!";

    $result = $wpdb->insert(
          $table,
          array(
        'fName' => $fName,
        'lName' => $lName,
        'username' => $username,
        'description' => $description,
        'athleteType' => $athleteType,
        'imagePath' => $defaultImage,
        'trainer' => "none",
        'status' => 'active',
        'annoucement' => $annoucement,
        'accountCreated' => $currentDate,
        'email' => $email
          )
      );

      return $result;

wp_die();
}

function store_new_workout_profile($username){
  global $wpdb;

  $table = $wpdb->prefix . "workouts";

  //Create Table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `username` text,
    `trainer` text,
    `type` text,
    `week` text,
    `day` text,
    `workout` text,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $result = $wpdb->insert(
          $table,
          array(
        'username' => $username,
        'trainer' => "none"
          )
      );

      return $result;

wp_die();
}

function store_new_trainer_profile($fName, $lName, $username, $description, $type, $currentDate, $email){
  global $wpdb;

  $table = $wpdb->prefix . "trainers";

  //default image
  $defaultImage = "wp-content/uploads/profile/default.png";

  //Create Table if it doesn't exist
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
    `accountCreated` date,
    `status` text,
    `username` text,
    `email` text,
    `fName` text,
    `lName` text,
    `athleteType` text,
    `phoneNumber` int,
    `birthday` date,
    `imagePath` text,
    `heightFeet` int,
    `heightInch` int,
    `weight` int,
    `purpose` text,
    `goal` text,
    `description` text,
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $result = $wpdb->insert(
          $table,
          array(
        'accountCreated' => $currentDate,
        'fName' => $fName,
        'lName' => $lName,
        'athleteType' => $type,
        'username' => $username,
        'description' => $description,
        'imagePath' => $defaultImage,
        'email' => $email
          )
      );

      return $result;

  wp_die();
}

function store_trainer_account(){
  global $wpdb;

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $description = $_POST['description'];

  $table = $wpdb->prefix . "members";

  //validate input
  if (preg_match('/[^A-Za-z0-9.#\\-$]/', $fName) || preg_match('/[^A-Za-z0-9.#\\-$]/', $lName)){
    exit("Please enter valid characters for First Name and Last Name");
  }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Invalid email format");
}

  //check if username exist

  	$sql = $wpdb->prepare("SELECT t.username FROM $table t Where t.username = %s", array($username));
    $result = $wpdb->get_results($sql);

    if(!empty($result)){
      exit("Username is already taken. Please try again.");
    }


$currentDate = current_time( 'mysql' );

$hashPass = wp_hash_password( $password );
// $salt = wp_salt($hashPass);
//
// $hashPass = $salt;

$type = "trainer";

$result = $wpdb->insert(
      $table,
      array(
    'fName' => $fName,
    'lName' => $lName,
    'type' => $type,
    'email' => $email,
    'username' => $username,
    'damn' => $hashPass,
    'created' => $currentDate
      )
  );

  if(!$result > 0 || !$result || $result === false){
    exit("I apologize, we are having issues submitting your information. Please contact us directly via email." .
    "Thank you for your understanding.");
  }else{
    //create profile
    $result = store_new_trainer_profile($fName, $lName, $username, $description, $type, $currentDate, $email);

    if(!$result > 0 || !$result || $result === false){
      exit("I apologize, we are having issues creating your profile. Please contact us directly via email." .
      "Thank you for your understanding.");
    }

    session_start();
    $_SESSION['member'] = $username;
    $_SESSION['type'] = $type;
    echo 1;
  }

wp_die();

}
add_action('wp_ajax_store_trainer_account', 'store_trainer_account');
add_action('wp_ajax_nopriv_store_trainer_account', 'store_trainer_account');

function store_new_account(){
  global $wpdb;

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $description = $_POST['description'];
  $athleteType = $_POST['athleteType'];

  $table = $wpdb->prefix . "members";

  //validate input
  if (preg_match('/[^A-Za-z0-9.#\\-$]/', $fName) || preg_match('/[^A-Za-z0-9.#\\-$]/', $lName)){
    exit("Please enter valid characters for First Name and Last Name");
  }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  exit("Invalid email format");
}

  //check if username exist

  $sql = $wpdb->prepare("SELECT t.username FROM $table t Where t.username = %s", array($username));
  $result = $wpdb->get_results($sql);

    if(!empty($result)){
      exit("Username is already taken. Please try again.");
    }

//Create Table if it doesn't exist
  $charset_collate = $wpdb->get_charset_collate();
  $sql = "CREATE TABLE IF NOT EXISTS $table (
      `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `created` date,
  `fName` text,
  `lName` text,
  `type` text,
  `email` text,
  `username` text,
  `damn` text,
  UNIQUE (`id`)
  ) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );

$currentDate = current_time( 'mysql' );

$hashPass = wp_hash_password( $password );
// $salt = wp_salt($hashPass);
//
// $hashPass = $salt;

$type = "client";

$result = $wpdb->insert(
      $table,
      array(
    'fName' => $fName,
    'lName' => $lName,
    'type' => $type,
    'email' => $email,
    'username' => $username,
    'damn' => $hashPass,
    'created' => $currentDate
      )
  );

  if(!$result > 0 || !$result || $result === false){
    exit("I apologize, we are having issues submitting your information. Please contact us directly via email." .
    "Thank you for your understanding.");
  }else{
    //create profile
    $result = store_new_profile($fName, $lName, $username, $description, $currentDate, $athleteType, $email);

    if(!$result > 0 || !$result || $result === false){
      exit("I apologize, we are having issues creating your profile. Please contact us directly via email." .
      "Thank you for your understanding.");
    }


    session_start();
    $_SESSION['member'] = $username;
    $_SESSION['type'] = $type;
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
		$itemMain[] = array($item->id, $item->type, $item->week, $item->day, $liftunserial);
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
		`type` text NOT NULL,
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
							'type' => $programVal
						)
				);

//if update Query > 0 then it successfully update
				if($resultUpdate > 0) {
					echo "Successfully Updated $weekVal and $dayVal to $programVal in the database!";
				}else if ($resultUpdate === 0) {

//If update Query === 0 then the table is not in the database OR the user didn't update any variables

										$result = $wpdb->get_results("SELECT * FROM $table WHERE type = '$programVal' and week = '$weekVal' and day = '$dayVal'");

										if($result == null){
															$resultInsert = $wpdb->insert(
																		$table,
																		array(
																	'type' => $programVal,
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

    // if (is_page('signup')){
    //     wp_enqueue_script('js_charge', get_stylesheet_directory_uri() . '/js/charge.js', array( 'jquery'), '1.0.0', true );
    // }

    if (is_page('available-clients')){
        wp_enqueue_script('js_trainer_available_clients', get_stylesheet_directory_uri() . '/js/trainers/trainer_available_clients.js', array( 'jquery'), '1.0.0', true );
    }

    if (is_page('my-clients')){
        wp_enqueue_script('js_trainer_my_clients', get_stylesheet_directory_uri() . '/js/trainers/trainer_my_clients.js', array( 'jquery' ), '1.0.0', true );
    }

    if (is_page('home')){
      wp_enqueue_script('js_trainer_profile', get_stylesheet_directory_uri() . '/js/trainers/trainer_profile.js', array( 'jquery' ), '1.0.0', true );

    }

    //signup.php and signup-trainer.php
    if (is_page( array(874, 897) ) ){
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
