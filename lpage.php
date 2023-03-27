<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if ($_SESSION['logout'] == "") {
  header("location:login.php");
}
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AutoLend</title>
  <link rel="icon" href="Images/Logo.png">
  <link rel="stylesheet" href="style.css">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />
  <!-- MDB -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
  <script src="navbarscrool.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- bootstrap cdn -->
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <!-- jquey cdn -->
  <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
  <script src="navbarscrool.js"></script>
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
  <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-scroll">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="Images/Logo.png" class="me-2" height="50" alt="AutoLend Logo" loading="lazy" />
          <small class="ms-2 text-light">AutoLend</small></a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars animated-icon3"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#!">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="search-cars.php">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Opinions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#!">Contact</a>
            </li>
          </ul>

          <!-- Collapsible wrapper -->

          <!-- Avatar -->
          <div class="dropdown ">
            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" height="35" width="35" alt="profile pic" loading="lazy" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
              <li>
                <a class="dropdown-item" href="userprofile.php">My profile</a>
              </li>
              <li>
                <a class="dropdown-item" href="view_bookings.php">View Booking</a>
              </li>
              <li>
                <a class="dropdown-item" href="sessiondestroy.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
        <!-- Right elements -->
      </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <!--Section: Design Block-->
    <section>
      <div id="intro" class="bg-image" style="
              background-image: url('Images/Untitled-1.png');
              height: 70vh;
            ">
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
          <div class="container d-flex justify-content-center align-items-center h-100">
            <div class="row align-items-center">
              <div class="col-12">
                <h1 class="mb-3 text-white h1">Your pick of rides at low prices</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Section: Design Block-->
  </header>

  <main>
    <div class="container my-4 py-4">
      <div class="h2 text-center">Better Way To Rent Your Perfect Cars</div>
      <div class="row my-4 py-4">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Choose Your Location</h5>
              <p class="card-text"><i class="fas fa-map-marked-alt fa-7x"></i></p>
            </div>
          </div>
        </div>
        <div class="col ">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Select Best Deal</h5>
              <p class="card-text"><i class="fas fa-handshake fa-7x"></i>
              </p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body .hover-zoom">
              <h5 class="card-title">Reserve your Car</h5>
              <p class="card-text"><i class="fas fa-car-alt fa-7x"></i>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="container my-2 py-2 section3">
      <div class="h3 text-center heading">We offer</div>
      <div class="h2 text-center subheading">Feautred Vehicles</div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div id="news-slider" class="owl-carousel">
              <div class="post-slide">
                <div class="post-img">
                  <img class="" src="images/cars/arteum-ro-_8WDl2zgB_0-unsplash.jpg
                            " alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>
              <div class="post-slide">
                <div class="post-img">
                  <img src="Images/cars/caleb-white-XGJBSkoqX_I-unsplash.jpg" alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>

              <div class="post-slide">
                <div class="post-img">
                  <img src="Images/cars/david-moffatt-bTp1ByhNzQg-unsplash.jpg" alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>

              <div class="post-slide">
                <div class="post-img">
                  <img class="" src="Images/cars/kenny-eliason-yDekvyZ52dU-unsplash.jpg" alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>

              <div class="post-slide">
                <div class="post-img">
                  <img src="Images/cars/tabea-schimpf-O7WzqmeYoqc-unsplash.jpg" alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>

              <div class="post-slide">
                <div class="post-img">
                  <img src="Images/cars/talia-sBPnD3jzQ7g-unsplash.jpg" alt="">
                  <a href="#" class="over-layer"><i class="fa fa-car-alt"></i></a>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Lorem ipsum dolor sit amet.</a>
                  </h3>
                  <span class="post-date"><i class="fa fa-dollar-sign text-danger"></i>500</span>
                  <a href="#" class="read-more">BOOK NOW</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container section4 my-2 py-2 ">
      <div class="main">
        <div class="img-container"></div>
        <!-- <h2>Title</h2> -->
        <br>
        <br>
        <br>
        <div class="h2 text-light sec-cont">Do You Want To Earn with us? So Don't Be Late.</div>
        <button type="button" class="btn btn-primary btn-rounded btn-add-car"> ADD Cars</button>
      </div>
    </div>
    <div class="container my-5 py-5 ">
      <section>
        <div class="row d-flex justify-content-center">
          <div class="col-md-10 col-xl-8 text-center">
            <h3 class="mb-4">Testimonials</h3>
            <p class="mb-4 pb-2 mb-md-5 pb-md-0">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit, error amet
              numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum
              quisquam eum porro a pariatur veniam.
            </p>
          </div>
        </div>

        <div class="row text-center d-flex align-items-stretch">
          <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
            <div class="card testimonial-card">
              <div class="card-up" style="background-color: #9d789b;"></div>
              <div class="avatar mx-auto bg-white">
                <img src="Images/Testimonial/img (9).webp" class="rounded-circle img-fluid" />
              </div>
              <div class="card-body">
                <h4 class="mb-4">Maria Smantha</h4>
                <hr />
                <p class="dark-grey-text mt-4">
                  <i class="fas fa-quote-left pe-2"></i>Lorem ipsum dolor sit amet eos adipisci,
                  consectetur adipisicing elit.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-5 mb-md-0 d-flex align-items-stretch">
            <div class="card testimonial-card">
              <div class="card-up" style="background-color: #7a81a8;"></div>
              <div class="avatar mx-auto bg-white">
                <img src="Images/Testimonial/img (2).webp" class="rounded-circle img-fluid" />
              </div>
              <div class="card-body">
                <h4 class="mb-4">Lisa Cudrow</h4>
                <hr />
                <p class="dark-grey-text mt-4">
                  <i class="fas fa-quote-left pe-2"></i>Neque cupiditate assumenda in maiores
                  repudi mollitia architecto.
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-0 d-flex align-items-stretch">
            <div class="card testimonial-card">
              <div class="card-up" style="background-color: #6d5b98;"></div>
              <div class="avatar mx-auto bg-white">
                <img src="Images/Testimonial/img (1).webp" class="rounded-circle img-fluid" />
              </div>
              <div class="card-body">
                <h4 class="mb-4">John Smith</h4>
                <hr />
                <p class="dark-grey-text mt-4">
                  <i class="fas fa-quote-left pe-2"></i>Delectus impedit saepe officiis ab
                  aliquam repellat rem unde ducimus.
                </p>
              </div>
            </div>
          </div>
        </div>
  </main>
  <!-- Remove the container if you want to extend the Footer to full width. -->
  <div class="">

    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-between p-4" style="background-color: #182b35">
        <!-- Left -->
        <div class="me-5">
          <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold">AutoLend</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Here you can use rows and columns to organize your footer
                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                elit.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Products</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">Home</a>
              </p>
              <p>
                <a href="#!" class="text-white">Services</a>
              </p>
              <p>
                <a href="#!" class="text-white">Opinions</a>
              </p>
              <p>
                <a href="#!" class="text-white">contact us</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Useful links</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">Your Account</a>
              </p>
              <p>
                <a href="#!" class="text-white">Add cars</a>
              </p>
              <p>
                <a href="#!" class="text-white">Trending cars</a>
              </p>
              <p>
                <a href="#!" class="text-white">Help</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Contact</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
              <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2023 Copyright:
        <a class="text-white" href="lpage.php">AutoLend</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->

  </div>
  <!-- End of .container -->
  <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
</body>

</html>