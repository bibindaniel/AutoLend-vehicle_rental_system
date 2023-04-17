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
    <link rel="stylesheet" href="adminpanel.css">
    <!-- data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link rel="stylesheet" href="vehicle_det.css">
</head>

<body>
    <?php
    $id = $_GET['id'];
    include 'dbconnect.php';
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
    <script>
        $(document).ready(function() {
            $('.ver_btn').click(function(e) {
                e.preventDefault();
                var userId = $(this).data('vehicle-id');
                var status = $(this).text()
                if (status == "NOT VERIFIED") {
                    $(this).removeClass('btn-danger').addClass('btn-success').text('VERIFIED')
                } else {
                    $(this).removeClass('btn-success').addClass('btn-danger').text('NOT VERIFIED')
                }

                // send ajax request to update user status in database
                $.ajax({
                    url: 'car_update.php',
                    type: 'POST',
                    data: {
                        user_id: userId
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="adminpage.php">Main DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="admin-cars.php">vehicle</a></li>
                        <li class="breadcrumb-item active" aria-current="page">vehicle details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-lg-7 pb-5 pe-lg-5">
                <div class="row">
                    <div class="col-12 p-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-mdb-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="3" aria-label="Slide 4"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="vehicle/<?= $row["image1"] ?>" class="d-block w-100" alt="Wild Landscape" />
                                </div>
                                <div class="carousel-item">
                                    <img src="vehicle/<?= $row["image2"] ?>" class="d-block w-100" alt="Camera" />
                                </div>
                                <div class="carousel-item">
                                    <img src="vehicle/<?= $row["image3"] ?>" class="d-block w-100" alt="Exotic Fruits" />
                                </div>
                                <div class="carousel-item">
                                    <img src="vehicle/<?= $row["image4"] ?>" class="d-block w-100" alt="Fourth Image" />
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="row m-0 bg-light">
                        <div class="d-flex align-items-end px-4 mt-4 mb-2">
                            <p class="h4 m-0"><span class="pe-1"><?= $row["brand_name"] ?></span><span class="pe-1"><?= $row["model_name"] ?></span><span class="pe-1"><?= $row["year"] ?></span></p>
                            <P class="ps-3 textmuted">1L</P>
                        </div>
                        <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                            <p class="text-muted">Mileage</p>
                            <p class="h5"><?= $row["mileage"] ?><span class="ps-1">Km</span></p>
                        </div>
                        <div class="col-md-4 col-6  ps-30 my-4">
                            <p class="text-muted">Transmission</p>
                            <p class="h5 m-0"><?= $row["transmission_type"] ?></p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">fuel</p>
                            <p class="h5 m-0"><?= $row["fuel_type"] ?></p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Seats</p>
                            <p class="h5 m-0"><?= $row["seat"] ?></p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Category</p>
                            <p class="h5 m-0"><?= $row2["category_name"] ?></p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Location</p>
                            <p class="h5 m-0"><?= $row["location"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-0 ps-lg-4">
                <div class="row m-0">
                    <div class="col-12 px-4 my-4">
                        <p class="fw-bold">Owner details</p>
                    </div>
                    <div class="col-12 px-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="Uploads/<?= $row1["image"] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height:150px">
                                <h5 class="my-3"><?= $row1["first_name"] ?></h5>
                                <p class="text-muted mb-1"><?= $row1["email"] ?></p>
                                <p class="text-muted mb-4"><?= $row1["mobile"] ?></p>
                                <div class="d-flex justify-content-center mb-2">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="row bg-light m-0">
                                <div class="col-12 px-4 my-4">
                                    <p class="fw-bold">Payment detail</p>
                                </div>
                                <div class="col-12 px-4">
                                    <div class="d-flex  mb-4">
                                        <span class="">
                                            <p class="text-muted">RC BOOK</p>
                                            <a class="modal-file1" href="vehicle/<?=$row["rcbook"]?>" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>
                                        </span>
                                        <div class=" w-100 d-flex flex-column align-items-end">
                                            <p class="text-muted">PUC Certificate</p>
                                            <a class="modal-file1" href="vehicle/<?=$row["puc"]?>" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-5">
                                        <span class="me-5">
                                            <p class="text-muted">Insurance</p>
                                            <a class="modal-file1" href="vehicle/<?=$row["insurance"]?>" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>
                                        </span>
                                        <div class="w-100 d-flex flex-column align-items-end">
                                            <p class="text-muted">Permit</p>
                                            <a class="modal-file1" href="vehicle/<?=$row["permit"]?>" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-12  mb-4 p-0">
                                    <?php if ($row["status"] == 0) { ?>
                                        <div class="btn btn-verify btn-danger ver_btn" data-vehicle-id="<?= $row["vehicle_id"] ?>">NOT VERIFIED</div>
                                    <?php } else { ?>
                                        <div class="btn btn-verify btn-success ver_btn" data-vehicle-id="<?= $row["vehicle_id"] ?>">VERIFIED</div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- data table -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
            <!--Main layout-->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>