<?php
include 'dbconnect.php';
$id = $_POST['id'];
$sql =  "UPDATE `tbl_request_vehicle` SET `request_status`='1' WHERE `request_id`= $id";
 $res=mysqli_query($con, $sql);
 if($res){
    echo"success";
 }
mysqli_close($con);
?>