<!DOCTYPE html>
<html lang="en">

<head>
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
</head>

<body>
    <!-- Sidebar -->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="owner-dashboard.php" class="list-group-item list-group-item-action py-2 ripple<?php if (basename($_SERVER['PHP_SELF']) == "owner-dashboard.php") {
                                                                                                                echo " active";
                                                                                                            } ?>" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="owner-add-car.php" class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == "owner-add-car.php") {
                                                                                                                echo " active";
                                                                                                            } ?>">
                        <i class="fas fa-plus-square fa-fw me-3"></i><span>Add cars</span>
                    </a>
                    <a href="owner-view-cars.php" class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == "owner-view-cars.php") {
                                                                                                                echo " active";
                                                                                                            } ?>"><i class="fas  fa-car fa-fw me-3"></i><span>View Cars</span></a>
                    <a href="owner-view-request.php" class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == "owner-view-request.php") {
                                                                                                                    echo " active";
                                                                                                                } ?>"><i class="fas fa-bell fa-fw me-3"></i><span>View Request</span></a>
                    <a href="owner_view_bookings.php" class="list-group-item list-group-item-action py-2 ripple <?php if (basename($_SERVER['PHP_SELF']) == "owner_view_bookings.php") {
                                                                                                echo " active";
                                                                                            } ?>"><i class="fas fa-address-book fa-fw me-3"></i><span>View Bookings</span></a>
                </div>
            </div>
        </nav>

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light  fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="images/Logo.png" height="45" alt="" loading="lazy" />
                    <small class="ms-2 text-light">AutoLend</small></a>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active text-light" href="l-car-owner-page.php">Home</a>
                        </li>
                    </ul>
                </div>
                <!-- Avatar -->
                <div class="dropdown ">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" height="35" width="35" alt="profile pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="l-car-owner-page.php">Home</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="sessiondestroy.php">Logout</a>
                        </li>
                    </ul>
                </div>

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>