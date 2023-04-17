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
</head>
<style>
    .gradient-custom {
        background: rgb(2, 0, 36);
        background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
    }
</style>

<body>
    <!--Main Navigation-->
    <?php
    $tmp_id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    ?>
    <?php
    include("adminsidebar.php");
    ?>
    <!--Main Navigation-->
    <?php
    $results_per_page = 9;

    //find the total number of results stored in the database  
    $query1 = "SELECT tbl_vehicle_booking.*,tbl_vehicle.*,owner.first_name AS owner_name,owner.image AS owner_image,borrower.first_name AS user_name,borrower.image AS user_image FROM tbl_vehicle_booking
    JOIN tbl_vehicle ON tbl_vehicle.vehicle_id=tbl_vehicle_booking.vehicle_id
    JOIN tbl_user AS owner ON tbl_vehicle.user_id=owner.login_id 
    JOIN tbl_user AS borrower ON  tbl_vehicle_booking.user_id=borrower.login_id";
    $result = mysqli_query($con, $query1);
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
    $query = "SELECT tbl_vehicle_booking.*,tbl_vehicle.*,owner.first_name AS owner_name,owner.image AS owner_image,borrower.first_name AS user_name,borrower.image AS user_image FROM tbl_vehicle_booking
    JOIN tbl_vehicle ON tbl_vehicle.vehicle_id=tbl_vehicle_booking.vehicle_id
    JOIN tbl_user AS owner ON tbl_vehicle.user_id=owner.login_id 
    JOIN tbl_user AS borrower ON  tbl_vehicle_booking.user_id=borrower.login_id  LIMIT " . $page_first_result . ',' . $results_per_page;
    $result = mysqli_query($con, $query);
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <h2>VEHICLE INFORMATION</h2>
            <hr class="mt-0 mb-4">
            <div class="row row-cols-1 row-cols-md-3">
                <?php while ($row1 = mysqli_fetch_array($result)) {
                    $id = $row1["vehicle_id"];
                ?>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <!--Card image-->
                            <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                                <img src="vehicle/<?= $row1["image1"] ?>" class="w-100 h-100 object-fit-cover" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                        <div class="d-flex justify-content-start align-items-start h-100">
                                            <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><?= $row1["brand_name"] ?> <?= $row1["model_name"] ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                    </div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-6 text-center">
                                        <img src="uploads/<?php echo $row1['user_image']; ?>" class="rounded-circle" alt="User profile image" style="width: 50px; height:50px">
                                        <h5><?php echo $row1['user_name'] ?></h5>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img src="uploads/<?php echo $row1['owner_image']; ?>" class="rounded-circle" alt="Owner profile image" style="width: 50px; height:50px">
                                        <h5><?php echo $row1['owner_name'] ?></h5>
                                    </div>
                                    <div class="col-md-12 m-2 ">
                                        <p>Start date: <?php echo $row1['start_date']; ?></p>
                                        <p>End date: <?php echo $row1['end_date']; ?></p>
                                        <p>Location: <?php echo $row1['drop_in_location']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Close the card element -->
                    </div>
                <?php } ?>
            </div>
            <?php
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            ?>
            <nav class="mt-4" aria-label="Page navigation sample">
                <ul class="pagination">
                    <?php if ($current_page > 1) : ?>
                        <li class="page-item"><a class="page-link" href="admin-bookings.php?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                    <?php else : ?>
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $number_of_page; $page++) : ?>
                        <?php if ($page == $current_page) : ?>
                            <li class="page-item active"><a class="page-link" href="#"><?php echo $page; ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="admin-bookings.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($current_page < $number_of_page) : ?>
                        <li class="page-item"><a class="page-link" href="admin-bookings.php?page=<?php echo $current_page + 1; ?>">Next</a></li>
                    <?php else : ?>
                        <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </main>

    </div>
    </main>
    <!-- data table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>