<?php
  $con = mysqli_connect("localhost", "root", "", "mini-prj");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $start_date = $_POST["start_date"];
  $vid=$_POST['vehicleID'];
  $query = "SELECT *
  FROM tbl_request_vehicle
  WHERE vehicle_id = $vid
    AND start_date <= '$start_date'
    AND end_date >= '$start_date'
  UNION
  SELECT *
  FROM tbl_vehicle_booking
  WHERE vehicle_id = $vid
    AND start_date <= '$start_date'
    AND end_date >= '$start_date'
    AND booking_status != 3";
  $result = mysqli_query($con, $query);
  if (mysqli_num_rows($result) > 0) {
    $response = array(
      "status" => "error",
      "message" => "This start date is already booked. Please choose another date."
    );
  } else {
    $response = array("status" => "success");
  }
  
  // return the response as JSON
  echo json_encode($response);
  mysqli_close($con);
