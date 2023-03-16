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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/fontawesome.min.css" integrity="sha512-cHxvm20nkjOUySu7jdwiUxgGy11vuVPE9YeK89geLMLMMEOcKFyS2i+8wo0FOwyQO/bL8Bvq1KMsqK4bbOsPnA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        background-color: rgb(2, 0, 36);
        background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
    }
</style>
<?php
$tmp_id = $_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$query3 = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);
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
                            <a class="nav-link active text-light" href="lpage.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#!">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="#!">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#!">Opinions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#!">Contact</a>
                        </li>
                    </ul>

                    <!-- Collapsible wrapper -->

                    <!-- Avatar -->
                    <div class="dropdown ">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img src="Uploads/<?php echo $row3['image'] ?>" class="rounded-circle" height="25" alt="profile pic" loading="lazy" />
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
    <?php
    $id = 35;
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query = "SELECT * FROM `tbl_vehicle` WHERE `vehicle_id`=$id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $usrid = $row["user_id"];
    $catid = $row["category_id"];
    $query1 = "SELECT * FROM `tbl_user` WHERE `login_id`=$usrid";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $query2 = "SELECT * FROM `tbl_vehicle_category` WHERE `category_id`=$catid";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($result2);

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow m-4">
                    <div class="row no-gutters">
                        <div class="row">
                            <div class="col-md-7 m-3">
                                <div class="container-fluid p-0">
                                    <div id="carouselExampleCrossfade" class="carousel slide carousel-fade" data-mdb-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="2" aria-label="Slide 3"></button>
                                            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="3" aria-label="Slide 4"></button>
                                        </div>
                                        <div class="carousel-inner rounded-5 shadow-4-strong">
                                            <div class="carousel-item active">
                                                <img src="vehicle/arteum-ro-_8WDl2zgB_0-unsplash.jpg" class="d-block w-100 " alt="Wild Landscape" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/caleb-white-XGJBSkoqX_I-unsplash.jpg" class="d-block w-100" alt="Camera" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/david-moffatt-bTp1ByhNzQg-unsplash.jpg" class="d-block w-100" alt="Exotic Fruits" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/david-moffatt-bTp1ByhNzQg-unsplash.jpg" class="d-block w-100" alt="Exotic Fruits" />
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 m-4">
                                <div class="row m-0 bg-light">
                                    <div class="d-flex align-items-end px-4 mt-4 mb-2">
                                        <p class="h4 m-0"><span class="pe-1"><?= $row["brand_name"] ?></span><span class="pe-1"><?= $row["model_name"] ?></span><span class="pe-1"><?= $row["year"] ?></span></p>
                                        <P class="ps-3 textmuted">1L</P>
                                    </div>
                                    <div class="d-flex align-items-center  mt-4 mb-2">
                                        <p class="text-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Neque tempore mollitia, iste soluta voluptate at voluptatibus magnam harum architecto omnis, ratione blanditiis nam distinctio quidem </p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class="fa-solid fa-gears"></i><span class="m-2">Automatic</span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-oil-can'></i><span class="m-2">12km</span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-gas-pump'></i><span class="m-2">Diseal</span></p>
                                    </div>

                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-car-side'></i><span class="m-2">hachback</span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-thumbtack'></i><span class="m-2">Asdf</span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-gas-pump'></i><span class="m-2">Autdf</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

</html>