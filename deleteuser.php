<?php
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $update_query = "UPDATE `tbl_user` SET user_status = '0' WHERE user_id = '$id'";
  mysqli_query($con, $update_query);
  $_SESSION["logout"] == "";
  session_destroy();
  header("location:login.php");
  mysqli_close($con);
?>