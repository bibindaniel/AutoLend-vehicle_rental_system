<?php
if(isset($_POST["name"]))
{
$connect = mysqli_connect("localhost", "root","", "mini-prj");
$name = mysqli_real_escape_string($connect, $_POST["name"]);
$query = "SELECT * FROM `tbl_vehicle_category` WHERE `category_name`= '$name'";
$result = mysqli_query($connect, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
?>