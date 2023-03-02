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
    <title>AUTOLEND</title>
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
    <link rel="stylesheet" href="search-cars.css">
</head>
<style>
    .gradient-custom {
    background-color: rgb(2,0,36);
    background: linear-gradient(280deg, rgba(2,0,36,1) 0%, rgba(14,72,73,1) 37%, rgba(0,212,255,1) 100%);
    }
</style>
<?php
$tmp_id = $_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$img = $row['image'];
?>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light solid-nav">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand" href="#"> <img src="Images/Logo.png" class="me-2" height="50" alt="AutoLend Logo" loading="lazy" />
                    <small class="ms-2 text-light">AutoLend</small></a>
                <!-- Left links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active"href="lpage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  aria-current="page"  href="#!">Services</a>
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
                            <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" height="25" alt="profile pic" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="userprofile.php">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">View Booking</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="sessiondestroy.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <?php
    $query1 = "SELECT * FROM `tbl_vehicle`";
    $result1 = mysqli_query($con, $query1);
    ?>
    <main>
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <?php
                    while ($row1 = mysqli_fetch_array($result1)) {
                    ?>
                        <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                            <div class="card text-center ">
                                <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light" style="height: 300px; overflow: hidden;">
                                    <img src="vehicle/<?= $row1["image"] ?>" class="img-fluid" />
                                    <a href="#!">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title"><?= $row1["model_name"] ?></h5>
                                        <p class="text-muted mb-4"><?= $row1["year"] ?></p>
                                    </div>
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <span><?= $row1["brand_name"] ?></span><span>$<?= $row1["rate"] ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span><?= $row1["location"] ?></span>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary gradient-custom  btn-sm" type="button">BOOK NOW</button>
                                </div>
                                <div class="card-footer">
                                    <div class="ms-auto text-warning">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
</body>
<script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

</html>