<?php
if (isset($_POST['user_id'])) {
  $id = $_POST['user_id'];
  include 'dbconnect.php';
  $query = "SELECT `status` FROM `tbl_vehicle_category` WHERE `category_id`=  '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  $current_status = $row['status'];
  if ($current_status == 1) {
    $new_status = 0; 
  } else {
    $new_status = 1; 
  }
  $update_query = "UPDATE `tbl_vehicle_category` SET `status`='$new_status' WHERE `category_id`= '$id'";
  mysqli_query($con, $update_query);

  mysqli_close($con);


}
?>
