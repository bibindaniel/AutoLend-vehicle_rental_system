<?php
if (isset($_POST['booking_id'])) {
  $id = $_POST['booking_id'];
  $vid=$_POST['vehicle_id'];
  echo $vid;
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $update_query = "UPDATE `tbl_vehicle_booking` SET `booking_status`='3' WHERE `booking_id`= '$id'";
  $res=mysqli_query($con, $update_query);
  $sql="UPDATE `tbl_vehicle` SET `booking_status`='available' WHERE `vehicle_id`= $vid";
  $res=mysqli_query($con, $sql);
  if($res){
    echo "success";
  }
  mysqli_close($con);

}
?>