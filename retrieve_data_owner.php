<?php
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  include 'dbconnect.php';
  $retrieve_query = "SELECT * FROM `tbl_user` WHERE `user_id` = '$id'";
  $result=mysqli_query($con, $retrieve_query);
  $row=mysqli_fetch_array($result);
  echo json_encode(array(
    'value1' => $row["first_name"],
    'value2' => $row["email"],
    'value3' => $row["mobile"],
    'value4' => $row["dob"],
    'value5' => $row["image"],
    'value8' => $row["location"]
));
  mysqli_close($con);


}
else {
    echo json_encode(array(
        'error' => "Error getting user!",
    ));
}
?>