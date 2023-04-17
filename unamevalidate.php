<?php
if(isset($_POST["name"]))
{
    include 'dbconnect.php';
$name = $_POST["name"];
$query = "SELECT * FROM `tbl_login` WHERE `user_name`='$name'";
$result = mysqli_query($con, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
?>