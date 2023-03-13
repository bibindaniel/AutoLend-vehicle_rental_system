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
    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Main DashBoard</a></li>
                        <li class="breadcrumb-item"><a href="#">vehicle</a></li>
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
                                    <img src="vehicle/arteum-ro-_8WDl2zgB_0-unsplash.jpg" class="d-block w-100" alt="Wild Landscape" />
                                </div>
                                <div class="carousel-item">
                                    <img src="vehicle/caleb-white-XGJBSkoqX_I-unsplash.jpg" class="d-block w-100" alt="Camera" />
                                </div>
                                <div class="carousel-item">
                                    <img src="vehicle/caleb-white-XGJBSkoqX_I-unsplash.jpg" class="d-block w-100" alt="Exotic Fruits" />
                                </div>
                                <div class="carousel-item">
                                    <img src="Images/cars/talia-sBPnD3jzQ7g-unsplash.jpg" class="d-block w-100" alt="Fourth Image" />
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
                            <p class="h4 m-0"><span class="pe-1">ZAZ</span><span class="pe-1">966</span><span class="pe-1">B</span></p>
                            <P class="ps-3 textmuted">1L</P>
                        </div>
                        <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                            <p class="text-muted">Mileage</p>
                            <p class="h5">25000<span class="ps-1">Km</span></p>
                        </div>
                        <div class="col-md-4 col-6  ps-30 my-4">
                            <p class="text-muted">Transmission</p>
                            <p class="h5 m-0">Manual</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">fuel</p>
                            <p class="h5 m-0">Front</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Seats</p>
                            <p class="h5 m-0">Coupe</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Category</p>
                            <p class="h5 m-0">White</p>
                        </div>
                        <div class="col-md-4 col-6 ps-30 my-4">
                            <p class="text-muted">Location</p>
                            <p class="h5 m-0">#002</p>
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
                                <img src="Images/users/aatik-tasneem-7omHUGhhmZ0-unsplash.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height:150px">
                                <h5 class="my-3">John Smith</h5>
                                <p class="text-muted mb-1">Full Stack Developer</p>
                                <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
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
                                            <a class="modal-file1" href="#" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>                                        </span>
                                        <div class=" w-100 d-flex flex-column align-items-end">
                                            <p class="text-muted">PUC Certificate</p>
                                            <a class="modal-file1" href="#" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-5">
                                        <span class="me-5">
                                            <p class="text-muted">Insurance</p>
                                            <a class="modal-file1" href="#" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>                                        </span>
                                        <div class="w-100 d-flex flex-column align-items-end">
                                            <p class="text-muted">Permit</p>
                                            <a class="modal-file1" href="#" target="_blank" data-mdb-ripple-color="dark"><i class="fas fa-address-card fa-5x"></i></a>                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-12  mb-4 p-0">
                                    <div class="btn btn-verify btn-danger">NoT verified<span class="fas fa-arrow-right ps-2"></span>
                                    </div>
                                </div>
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