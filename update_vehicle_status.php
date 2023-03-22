<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the vehicle ID and status from your AJAX request
$vehicle_id = $_POST['vehicle_id'];
$user_id= $_POST['user_id'];
$new_status = "available";

// Update the vehicle's status in your database
$sql =  "UPDATE `tbl_vehicle` SET `booking_status`='$new_status' WHERE `vehicle_id`=$vehicle_id";
$query = "DELETE FROM `tbl_request_vehicle` WHERE `vehicle_id`='$vehicle_id' AND `user_id`='$user_id'";
 $res=mysqli_query($conn, $query);
 if($res){
    echo"success";
 }
if (mysqli_query($conn, $sql)) {
  echo "Vehicle status updated successfully";
} else {
  echo "Error updating vehicle status: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
