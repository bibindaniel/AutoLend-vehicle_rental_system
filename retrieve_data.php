<?php
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $retrieve_query = "SELECT * FROM `tbl_user` WHERE `user_id` = '$id'";
  $result=mysqli_query($con, $retrieve_query);
  $row=mysqli_fetch_array($result);
  //query to retrive from tbl_verify_user
  $retrieve_query1 = "SELECT * FROM `tbl_verify_user` WHERE `user_id` = '$id'";
  $result1=mysqli_query($con, $retrieve_query1);
  $row1=mysqli_fetch_array($result1);
  if($row1["verify_status"]==1){
    $lno=$row1["licence_no"];
    $exdate=$row1["Expiry_date"];
    $file=$row1["licence_file"];
  }else{
    $lno="Not updated";
    $exdate="Not updated";
    $file="Not updated";
  }
  echo json_encode(array(
    'id' => $id,
    'value1' => $row["first_name"],
    'value2' => $row["email"],
    'value3' => $row["mobile"],
    'value4' => $row["dob"],
    'value5' => $row["image"],
    'status' => $row1["verify_status"],
    'value6' => $lno,
    'value7' => $exdate,
    'value8' => $row["location"],
    'value9' => $file
));
  mysqli_close($con);


}
else {
    echo json_encode(array(
        'error' => "Error getting user!",
    ));
}
?>