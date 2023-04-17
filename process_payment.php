<?php
include 'dbconnect.php';

$id = $_POST['itemId'];
$amt=$_POST['amount'];
$razorpayPaymentId=$_POST['razorpayPaymentId'];
$sql =  "INSERT INTO `tbl_payment`(`amount`, `razorpaymentid`, `request_id`) VALUES ('$amt','$razorpayPaymentId','$id')";
$res=mysqli_query($con, $sql);
$sql="UPDATE `tbl_request_vehicle` SET `request_status`='2' WHERE `request_id`=$id";
$res=mysqli_query($con, $sql);
$sql="SELECT `vehicle_id` FROM `tbl_request_vehicle` WHERE `request_id`=$id";
$res=mysqli_query($con, $sql);
$row=mysqli_fetch_array($res);
$v_id=$row["vehicle_id"];
$sql="UPDATE `tbl_vehicle` SET `booking_status`='Booked' WHERE `vehicle_id`=$v_id";
$res=mysqli_query($con,$sql);
$sql="INSERT INTO tbl_vehicle_booking 
(user_id, vehicle_id, start_date, end_date, drop_in_location, drop_in_time, drop_of_location, drop_of_time) 
SELECT user_id, vehicle_id, start_date, end_date, drop_in_location, drop_in_time, drop_of_location, drop_of_time 
FROM tbl_request_vehicle WHERE request_id = $id";
$res=mysqli_query($con,$sql);
$book_id=mysqli_insert_id($con);
$sql="UPDATE `tbl_payment` SET `request_id`='$book_id' WHERE `request_id`=$id";
mysqli_query($con,$sql);
$del_req="DELETE  FROM `tbl_request_vehicle` WHERE request_id = $id";
$result=mysqli_query($con,$del_req);
 if($res){
    echo"success";
 }
mysqli_close($con);
?>