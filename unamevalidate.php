<?php
if(isset($_POST["name"]))
{
$connect = mysqli_connect("localhost", "root","", "mini-prj");
$name = $_POST["name"];
$query = "SELECT * FROM `tbl_login` WHERE `user_name`='$name'";
$result = mysqli_query($connect, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
?>