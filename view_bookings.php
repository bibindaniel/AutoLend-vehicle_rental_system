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
    <link rel="stylesheet" href="confrimmodal.css">
</head>
<style>
    .solid-nav {
        background-color: #173841;
        transition: background-color 0.2s linear;
    }

    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    .btn-rectangle {
        border-radius: 0;
        height: 40px;
        padding: 7px 20px;
    }

    .btn-danger.btn-rectangle {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-success.btn-rectangle {
        background-color: #28a745;
        color: white;
        border: none;
    }
</style>
<script>
    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var status = $("#bookbtn").text()
            if (status != 'BOOK NOW') {
                $("#modal-btn1").click();
            }
        });
        $("#btn1").click(function() {
            var vehicleID = $(this).data("vehicle-id");
            var userID = $("#hid").data("user-id");

            $.ajax({
                url: "update_vehicle_status.php",
                type: "POST",
                data: {
                    vehicle_id: vehicleID,
                    user_id: userID,
                    status: "requested"
                },
                cache: false,
                success: function(response) {
                    location.reload();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    // Error message
                    alert("Error: " + errorThrown);
                }
            });
        });
    })
</script>
<?php
$tmp_id = $_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$query3 = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);
?>


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
                        <a class="nav-link text-light" aria-current="page" href="search-cars.php">Services</a>
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
<!-- Main Content -->
<main>
    <div class="container my-5">
        <h2 class="fw-bold mb-4">View Bookings</h2>
        <hr>
        <?php
        $results_per_page = 9;

        //find the total number of results stored in the database  
        $query = "SELECT tbl_request_vehicle.*, tbl_vehicle.brand_name,tbl_vehicle.model_name,tbl_vehicle.image1,tbl_vehicle.rate
        FROM tbl_request_vehicle JOIN tbl_vehicle ON tbl_request_vehicle.vehicle_id=tbl_vehicle.vehicle_id WHERE tbl_request_vehicle.user_id=$tmp_id";
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
        $query = "SELECT tbl_request_vehicle.*, tbl_vehicle.brand_name,tbl_vehicle.model_name,tbl_vehicle.image1,tbl_vehicle.rate
        FROM tbl_request_vehicle JOIN tbl_vehicle ON tbl_request_vehicle.vehicle_id=tbl_vehicle.vehicle_id WHERE tbl_request_vehicle.user_id=$tmp_id  LIMIT " . $page_first_result . ',' . $results_per_page;
        $result = mysqli_query($con, $query);
        if (empty($number_of_page)) : ?>
            <div class="alert alert-warning text-center mt-5" role="alert">
                You have no bookings.
            </div> <?php
                endif;
                    ?>
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php while ($row = mysqli_fetch_array($result)) {

                    $start_date = $row['start_date'];
                    $end_date = $row['end_date'];


                    $start_timestamp = strtotime($start_date);
                    $end_timestamp = strtotime($end_date);


                    $time_diff = $end_timestamp - $start_timestamp;


                    $days = round($time_diff / (60 * 60 * 24));

                    if ($days == 0) {

                        $days = 1;
                    }

                    $rent_per_day = $row['rate'];


                    $total_rent = $days * $rent_per_day;
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                                <img src="vehicle/<?= $row['image1'] ?>" class="w-100 h-100 object-fit-cover" />
                                <?php $id = $row['vehicle_id'] ?>
                                <a href="vehicle_det_usr.php?id= <?= $id ?>">
                                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                        <div class=" px-1 d-flex justify-content-end align-items-start h-100">
                                            <?php
                                            if ($row['request_status'] == 0) {
                                            ?>
                                                <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">Pending</span></h5>

                                            <?php
                                            } else if ($row['request_status'] == 1) {
                                            ?>
                                                <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">Accepted</span></h5>

                                            <?php
                                            } else {
                                            ?>
                                                <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark">Rejected</span></h5>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Booking Request</h5>
                                <p class="card-text"><strong>Vehicle:</strong> <?= $row['brand_name'] ?> <?= $row['model_name'] ?></p>
                                <p class="card-text"><strong>Dates:</strong> <?= $row['start_date'] ?> - <?= $row['end_date'] ?></p>
                                <p class="card-text"><strong>Pick-up Location:</strong> <?= $row['drop_in_location'] ?> <?= $row['drop_in_time'] ?></p>
                                <p class="card-text"><strong>Drop-off Location:</strong> <?= $row['drop_of_location'] ?> <?= $row['drop_of_time'] ?></p>
                                <p class="card-text"><strong>Total Amount:</strong><?= $total_rent ?></p>
                                <input type="hidden" name="hidden" id="hid" data-user-id="<?= $tmp_id ?>">
                                <button type="button" class="btn btn-danger btn-rectangle m-2">cancel</button>
                                <?php
                                if ($row['request_status'] == 1) {
                                ?>
                                    <button type="button" class="btn btn-success mr-3 btn-rectangle m-2 ">PAY NOW</button>

                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
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
                <li class="page-item"><a class="page-link" href="search-cars.php?page=<?php echo $current_page - 1; ?>">Previous</a></li>
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
                    <li class="page-item"><a class="page-link" href="search-cars.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($max_links < $number_of_page) : ?>
                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
            <?php endif; ?>

            <?php if ($current_page < $number_of_page) : ?>
                <li class="page-item"><a class="page-link" href="search-cars.php?page=<?php echo $current_page + 1; ?>">Next</a></li>
            <?php else : ?>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</main>
<button type="button" id="modal-btn1" style="display:none;" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#delModal">
    Launch demo modal
</button>
<!-- Modal del -->
<div id="delModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color:#fa0000;">
                    <i class="fa fa-times fa-3x"></i>
                </div>
                <h4 class="modal-title w-100">Confirm!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Are you sure? Do you want to cancel your request!..</p>
            </div>
            <div class="modal-footer d-grid d-md-flex justify-content-center">
                <button type="button" id="btn1" data-vehicle-id="<?= $id ?>" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
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