<?php
include 'dbconnect.php';

$id = $_POST['id'];
$vehicleID=$_POST["vehicleID"];

$sql1="UPDATE `tbl_vehicle` SET `booking_status`='available' WHERE `vehicle_id`=$vehicleID";
$sql =  "UPDATE `tbl_request_vehicle` SET `request_status`='-1' WHERE `request_id`= $id";
$res=mysqli_query($con, $sql);
$res1=mysqli_query($con,$sql1);
 if($res and $res1){
    echo"success";
 }
mysqli_close($con);
?>