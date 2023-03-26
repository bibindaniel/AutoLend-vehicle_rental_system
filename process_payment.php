<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['itemId'];
$amt=$_POST['amount'];
$razorpayPaymentId=$_POST['razorpayPaymentId'];
$sql =  "INSERT INTO `tbl_payment`(`amount`, `razorpaymentid`, `request_id`) VALUES ('$amt','$razorpayPaymentId','$id')";
$res=mysqli_query($conn, $sql);
$sql="UPDATE `tbl_request_vehicle` SET `request_status`='2' WHERE `request_id`=$id";
$res=mysqli_query($conn, $sql);
$sql="SELECT `vehicle_id` FROM `tbl_request_vehicle` WHERE `request_id`=$id";
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($res);
$v_id=$row["vehicle_id"];
$sql="UPDATE `tbl_vehicle` SET `booking_status`='Booked' WHERE `vehicle_id`=$v_id";
$res=mysqli_query($conn,$sql);
 if($res){
    echo"success";
 }
mysqli_close($conn);
?>