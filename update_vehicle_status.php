<?php
include 'dbconnect.php';

// Get the vehicle ID and status from your AJAX request
$vehicle_id = $_POST['vehicle_id'];
$user_id= $_POST['user_id'];
$new_status = "available";

// Update the vehicle's status in your database
$sql =  "UPDATE `tbl_vehicle` SET `booking_status`='$new_status' WHERE `vehicle_id`=$vehicle_id";
$query = "DELETE FROM `tbl_request_vehicle` WHERE `vehicle_id`='$vehicle_id' AND `user_id`='$user_id'";
 $res=mysqli_query($con, $query);
 if($res){
    echo"success";
 }
if (mysqli_query($con, $sql)) {
  echo "Vehicle status updated successfully";
} else {
  echo "Error updating vehicle status: " . mysqli_error($con);
}

mysqli_close($con);
?>
