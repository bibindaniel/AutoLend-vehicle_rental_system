<?php
if(isset($_POST["email"]))
{
$connect = mysqli_connect("localhost", "root","", "mini-prj");
$email = mysqli_real_escape_string($connect, $_POST["email"]);
$query = "SELECT * FROM `tbl_user` WHERE  email = '$email'";
$result = mysqli_query($connect, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
?>