<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$sql =  "UPDATE `tbl_request_vehicle` SET `request_status`='1' WHERE `request_id`= $id";
 $res=mysqli_query($conn, $sql);
 if($res){
    echo"success";
 }
mysqli_close($conn);
?>