<?php
$table = $wpdb->prefix . "clients";
$result = $wpdb->get_results("SELECT t.fName, t.lName, t.imagePath, t.goal, t.username, t.annoucement FROM $table t WHERE t.trainer = 'none'");


if(empty($result)){
  echo "<h2>No Clients Available</h2>";
}else{
?>
<form id = "available-clients" name = "available-clients" method = "post">
<input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $_SESSION['member']; ?>" readonly hidden/>
<table>
  <tr>
    <th><p>Register Client</p></th>
    <th><p>Profile Picture</p></th>
    <th><p>Username</p></th>
    <th><p>First Name</p></th>
    <th><p>Last Name</p></th>
    <th><p>Goal</p></th>
  </tr>
<?php
foreach($result as $item){

  $fName = $item->fName;
  $lName = $item->lName;
  $imagePath = $item->imagePath;
  $username = $item->username;
  $goal = $item->goal;

  ?>
      <tr>
        <th><input type = "checkbox" name = "available-clients-checkbox" value = "<?php echo $username; ?>"></input></th>
        <th><img src = "<?php echo site_url($imagePath); ?>"/></th>
        <th><p> <?php echo $username; ?> </p></th>
        <th><p> <?php echo $fName; ?> </p></th>
        <th><p> <?php echo $lName; ?> </p></th>
        <th><p> <?php echo $goal; ?> </p></th>
      </tr>
  <?php
}
?>
    </table>
    <input type = "submit" id = "available-clients-submit" name = "available-clients-submit">
    </form>
<?php } ?>

<form id = "annoucement" name = "annoucement" method = "post">
  <input type = "text" name = "trainer-username" id = "trainer-username" value = "<?php echo $_SESSION['member']; ?>" readonly hidden/>
Make an Annoucement: <input type ="text" name = "annoucement-input" id = "annoucement-input" value = "<?php echo stripslashes($annoucement); ?>" />
<input type = "submit" id = "annoucement-submit" name = "annoucement-submit">
</form>
