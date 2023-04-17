<?php
if (isset($_POST['user_id'])) {
  $id = $_POST['user_id'];
  include 'dbconnect.php';
  $query = "SELECT user_status FROM `tbl_user` WHERE user_id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $current_status = $row['user_status'];
  if ($current_status == 1) {
    $new_status = 0; 
  } else {
    $new_status = 1; 
  }
  $update_query = "UPDATE `tbl_user` SET user_status = '$new_status' WHERE user_id = '$id'";
  mysqli_query($con, $update_query);

  mysqli_close($con);


}
?>
