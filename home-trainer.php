<?php
$table = $wpdb->prefix . "clients";
$result = $wpdb->get_results("SELECT t.fName, t.lName, t.imagePath, t.goal, t.username FROM $table t WHERE t.trainer IS NULL");


if(empty($result)){
  header("Location: ?empty");
}
?>
<form id = "available-clients" name = "available-clients" method = "post">
<?php
foreach($result as $item){
  $fName = $item->fName;
  $lName = $item->lName;
  $imagePath = $item->imagePath;
  $username = $item->username;
  $goal = $item->goal;
  ?>
  <input type = "checkbox" name = "available-clients-checkbox"> <?php echo $username; ?> </input>
  <?php
}
?>
<input type = "submit" id = "available-clients-submit" name = "available-clients-submit">
</form>

<form id = "annoucement" name = "annoucement" method = "post">
Make an Annoucement: <input type ="text" name = "annoucement" id = "annoucement" value = "<?php echo stripslashes($annoucement); ?>" />
<input type = "submit" id = "annoucement-submit" name = "annoucement-submit">
</form>
