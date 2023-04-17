<?php
include 'dbconnect.php';
$id=$_POST['id'];
$status=$_POST['status'];
if($status=='Active'){
    $newstatus=0;
}else{
    $newstatus=1;
}
$sql="UPDATE `tbl_vehicle` SET `Availability`='$newstatus' WHERE `vehicle_id`=$id";
$res=mysqli_query($con,$sql);
if($res){
    echo"success";
}
mysqli_close($con);
?>
