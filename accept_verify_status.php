<?php
if (isset($_POST['user_id'])) {
  $id = $_POST['user_id'];
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $new_status=1;
  $update_query = "UPDATE `tbl_verify_user` SET`verify_status`='$new_status' WHERE `user_id` = '$id'";
  mysqli_query($con, $update_query);

  mysqli_close($con);


}
?>
