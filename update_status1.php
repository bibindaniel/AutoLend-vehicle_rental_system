<?php
if (isset($_POST['user_id'])) {
  $id = $_POST['user_id'];
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $query = "SELECT verify_status FROM `tbl_verify_user` WHERE user_id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $current_status = $row['verify_status'];
  if ($current_status == 0) {
    $new_status = 1; 
  } else {
    $new_status = -1; 
  }
  echo $new_status;
  $update_query = "UPDATE `tbl_verify_user` SET verify_status = '$new_status' WHERE user_id = '$id'";
  mysqli_query($con, $update_query);

  mysqli_close($con);


}
?>