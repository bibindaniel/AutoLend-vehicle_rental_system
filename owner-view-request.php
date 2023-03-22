<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['logout'] == "") {
    header("location:login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autolend</title>
    <link rel="icon" href="Images/Logo.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <?php
    $tmp_id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    ?>
    <!--Main Navigation-->
    <?php
    include("sidebar.php");
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
<div class="container mt-5">
  <h1>Requests to Rent Your Car</h1>
  <hr>
  <div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="vehicle/arteum-ro-_8WDl2zgB_0-unsplash.jpg" alt="Car Image" class="img-fluid rounded-start car-image">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title mb-4">Request for Honda Civic</h5>
        <div class="row mb-3">
          <div class="col-md-2 text-center">
            <img src="Images/users/aatik-tasneem-7omHUGhhmZ0-unsplash.jpg" height="25" alt="User Image" class="rounded-circle user-image">
            <p class="mt-2">John Doe</p>      
          </div>
          <div class="col-md-10">
            <p><strong>Dates:</strong> June 1st, 2022 - June 5th, 2022</p>
            <p><strong>Pick-up Location:</strong> Los Angeles International Airport</p>
            <p><strong>Drop-off Location:</strong> San Francisco International Airport</p>
          </div>
        </div>
        <button type="button" class="btn btn-success mr-3">Accept</button>
        <button type="button" class="btn btn-danger">Reject</button>
      </div>
    </div>
  </div>
</div>
      
      <div class="card mb-3">
        <div class="card-body bg-light">
          <h5 class="card-title">Request for Lamborghini Aventador</h5>
          <p class="card-text"><strong>Requested by:</strong> Jane Smith</p>
          <p class="card-text"><strong>Dates:</strong> 03/15/2022 - 03/20/2022</p>
          <p class="card-text"><strong>Pick-up Location:</strong> Miami, FL</p>
          <p class="card-text"><strong>Drop-off Location:</strong> Las Vegas, NV</p>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary"><i class="fas fa-check"></i> Accept</button>
            <button type="button" class="btn btn-secondary"><i class="fas fa-times"></i> Reject</button>
          </div>
        </div>
      </div>

      <!-- Add more cards here -->
    </div>
  </div>
</div>



    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>