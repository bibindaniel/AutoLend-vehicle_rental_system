<?php
if (isset($_POST['booking_id'])) {
  $id = $_POST['booking_id'];
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $update_query = "UPDATE `tbl_vehicle_booking` SET `booking_status`='2' WHERE `booking_id`= '$id'";
  $res=mysqli_query($con, $update_query);
  if($res){
    echo "success";
  }
  mysqli_close($con);

}
?>