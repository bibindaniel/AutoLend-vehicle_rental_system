<?php
if(isset($_POST["name"]))
{
    include 'dbconnect.php';
$name = mysqli_real_escape_string($con, $_POST["name"]);
$query = "SELECT * FROM `tbl_vehicle_category` WHERE `category_name`= '$name'";
$result = mysqli_query($con, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
