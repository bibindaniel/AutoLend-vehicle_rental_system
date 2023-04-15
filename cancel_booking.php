<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the vehicle ID and status from your AJAX request
$vehicle_id = $_POST['vehicle_id'];
$booking_id= $_POST['booking_id'];
$new_status = "available";

// Update the vehicle's status in your database
$sql =  "UPDATE `tbl_vehicle` SET `booking_status`='$new_status' WHERE `vehicle_id`=$vehicle_id";
$query = "UPDATE `tbl_vehicle_booking` SET `booking_status`='4' WHERE `booking_id`=$booking_id";
$res=mysqli_query($conn, $query);
 if($res){
    echo"success";
 }
 $query="SELECT  `amount` FROM `tbl_payment` WHERE `request_id`=$booking_id"; 
 $res=mysqli_query($conn, $query);
 $row=mysqli_fetch_array($res);
 $amount=$row["amount"];
 $amount=$amount * 0.1;
 $query="UPDATE `tbl_payment` SET `amount`= $amount WHERE `request_id`=$booking_id";
 $res=mysqli_query($conn, $query);
if (mysqli_query($conn, $sql)) {
  echo "Vehicle status updated successfully";
} else {
  echo "Error updating vehicle status: " . mysqli_error($conn);
}

mysqli_close($conn);
?>