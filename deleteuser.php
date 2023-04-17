<?php
include 'dbconnect.php';
  $update_query = "UPDATE `tbl_user` SET user_status = '0' WHERE user_id = '$id'";
  mysqli_query($con, $update_query);
  $_SESSION["logout"] == "";
  session_destroy();
  header("location:login.php");
  mysqli_close($con);
?>