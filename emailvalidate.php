<?php
if(isset($_POST["email"]))
{
    include 'dbconnect.php';
$email = mysqli_real_escape_string($con, $_POST["email"]);
$query = "SELECT * FROM `tbl_user` WHERE  email = '$email'";
$result = mysqli_query($con, $query);
$count=mysqli_num_rows($result);
echo mysqli_num_rows($result);
}
?>