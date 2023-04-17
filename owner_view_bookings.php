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
<style>
  .green_clr {
    background-color: #203740;
  }
</style>

<body>
  <?php
  $tmp_id = $_SESSION['id'];
  include 'dbconnect.php';
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
  <?php
  $results_per_page = 3;

  //find the total number of results stored in the database  
  $query = "SELECT tbl_vehicle_booking.*, tbl_vehicle.image1,tbl_vehicle.brand_name,tbl_vehicle.model_name
  FROM tbl_vehicle_booking
  JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id = tbl_vehicle.vehicle_id
  WHERE tbl_vehicle.user_id = $tmp_id ";
  $result = mysqli_query($con, $query);
  $number_of_result = mysqli_num_rows($result);

  //determine the total number of pages available  
  $number_of_page = ceil($number_of_result / $results_per_page);

  //determine which page number visitor is currently on  
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  //determine the sql LIMIT starting number for the results on the displaying page  
  $page_first_result = ($page - 1) * $results_per_page;

  //retrieve the selected results from database   
  $query = "SELECT tbl_vehicle_booking.*, tbl_vehicle.image1,tbl_vehicle.brand_name,tbl_vehicle.model_name
  FROM tbl_vehicle_booking
  JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id = tbl_vehicle.vehicle_id
  WHERE tbl_vehicle.user_id = $tmp_id  LIMIT " . $page_first_result . ',' . $results_per_page;
  $result = mysqli_query($con, $query);
  $count = mysqli_num_rows($result)
  ?>
  <main style="margin-top: 58px">
    <div class="container mt-5 pt-4">
      <h1>Your Bookings</h1>
      <hr>
      <div class="row row-cols-1 row-cols-md-12 g-4">
        <?php while ($row = mysqli_fetch_array($result)) { ?>
          <div class="card shadow-sm">
            <div class="row g-0">
              <div class="col-md-4 mt-3">
                <div class="bg-image hover-zoom ripple rounded" style="height: 270px; overflow: hidden;">
                  <img src="vehicle/<?= $row['image1'] ?>" class="w-100 h-100 object-fit-cover" />
                  <div class="hover-overlay">
                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <h5 class="card-title mb-0" data-vid="123"><?= $row['brand_name'] ?> <?= $row['model_name'] ?></h5>
                    <?php
                    $id=$row['booking_id'];
                     $rate_sql="SELECT * FROM `tbl_payment` WHERE `request_id`= $id";
                     $ans=mysqli_query($con,$rate_sql);
                     $row3=mysqli_fetch_array($ans);
                    ?>
                    <p class="card-text mb-0"><strong>Total Amount:</strong> <?=$row3['amount']?></p>
                  </div>
                  <hr>
                  <p class="card-text mb-0"><strong>Dates:</strong> <?= $row['start_date'] ?> - <?= $row['end_date'] ?></p>
                  <p class="card-text mb-0"><strong>Pick-up Location:</strong> <?= $row['drop_in_location'] ?> <?= $row['drop_in_time'] ?></p>
                  <p class="card-text mb-0"><strong>Drop-off Location:</strong> <?= $row['drop_of_location'] ?> <?= $row['drop_of_time'] ?></p>
                  <hr>
                  <?php
                  $id = $row['user_id'];
                  $query1 = "SELECT * from tbl_user where 	login_id ='$id'";
                  $result1 = mysqli_query($con, $query1);
                  $row1 = mysqli_fetch_array($result1);
                  ?>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column">
                      <p class="card-text mb-1"><small class="text-muted"><span class="fw-bold">Booked by:</span> <?= $row1['first_name'] ?></small></p>
                      <p class="card-text mb-1"><small class="text-muted"><span class="fw-bold">Email:</span> <?= $row1['email'] ?></small></p>
                      <p class="card-text mb-0"><small class="text-muted"><span class="fw-bold">Phone:</span> <?= $row1['mobile'] ?></small></p>
                    </div>
                    <div class="rounded-circle overflow-hidden" style="width: 40px; height: 40px;">
                      <img src="Uploads/<?php echo $row1['image'] ?>" class="w-100 h-100 object-fit-cover" />
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php
      // Set the number of links to display
      $links_limit = 5;
      $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

      // Calculate the offset based on the current page
      $offset = max(1, $current_page - intval($links_limit / 2));

      // Calculate the maximum number of links to display
      $max_links = min($number_of_page, $offset + $links_limit - 1);

      // If the maximum number of links is less than the limit, adjust the offset accordingly
      if ($max_links - $offset + 1 < $links_limit) {
        $offset = max(1, $max_links - $links_limit + 1);
      }
      ?>
      <nav class="mt-4" aria-label="Page navigation sample">
        <ul class="pagination">
          <?php if ($current_page > 1) : ?>
            <li class="page-item"><a class="page-link" href="owner_view_bookings.php?page=<?php echo $current_page - 1; ?>">Previous</a></li>
          <?php else : ?>
            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
          <?php endif; ?>

          <?php if ($offset > 1) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
          <?php endif; ?>

          <?php for ($page = $offset; $page <= $max_links; $page++) : ?>
            <?php if ($page == $current_page) : ?>
              <li class="page-item active"><a class="page-link" href="#"><?php echo $page; ?></a></li>
            <?php else : ?>
              <li class="page-item"><a class="page-link" href="owner_view_bookings.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($max_links < $number_of_page) : ?>
            <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
          <?php endif; ?>

          <?php if ($current_page < $number_of_page) : ?>
            <li class="page-item"><a class="page-link" href="owner_view_bookings.php?page=<?php echo $current_page + 1; ?>">Next</a></li>
          <?php else : ?>
            <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
          <?php endif; ?>
        </ul>
      </nav>

  </main>
  <!--Main layout-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>