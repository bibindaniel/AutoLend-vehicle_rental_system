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
    <script>
        $(document).ready(function() {
            var table = $('#mytable').DataTable({
                "lengthChange": false,
                pageLength: 4,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
            $('.ver_btn').click(function(e) {
                e.preventDefault();
                var userId = $(this).data('vehicle-id');
                var status = $(this).text()
                // update user status and icon
                if (status == 'Not verified') {
                    $(this).removeClass('btn-outline-danger').addClass('btn-outline-success').text('verified');
                } else if (status == 'verified') {
                    $(this).removeClass('btn-outline-success').addClass('btn-outline-danger').text('Not verified');
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
    <!--Main Navigation-->
    <?php
    $tmp_id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    ?>
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="adminpage.php" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="admin-users.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-users fa-fw me-3"></i><span>Users</span>
                    </a>
                    <a href="admin-owner.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user fa-fw me-3"></i><span>car owner</span></a>
                    <a href="admin-verify.php" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-check-circle fa-fw me-3"></i><span>verify Users</span></a>
                    <a href="admin-add-cat.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-solid fa-server fa-fw me-3"></i><span>Add category</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-solid fa-car fa-fw me-3"></i><span>vehicles</span></a>

                </div>
            </div>
        </nav>
        <!-- Sidebar -->

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
                <small class="h3 text-light font-weight-bold text-align-center">ADMIN PANEL</small></a>
                <!-- Avatar -->
                <div class="dropdown ">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" height="25" alt="profile pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="sessiondestroy.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">My profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->
    <?php
    $results_per_page = 9;

    //find the total number of results stored in the database  
    $query1 = "select *from `tbl_vehicle`";
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
    $query = "SELECT *FROM `tbl_vehicle`  LIMIT " . $page_first_result . ',' . $results_per_page;
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
                                            <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><?= $row1["rate"] ?></span></h5>
                                        </div>
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                    </div>
                                </a>
                            </div>

                            <!--Card content-->
                            <div class="card-body">
                                <!--Title-->
                                <h4 class="card-title"><?= $row1["brand_name"] ?> <?= $row1["model_name"] ?></h4>
                                <!--Text-->
                                <div>
                                    <div><i class='fas fa-gas-pump'></i><span class="p-2"><?= $row1["fuel_type"] ?></span></div>
                                    <div><i class='fas fa-map-marker-alt'></i><span class="p-2"><?= $row1["location"] ?></span></div>
                                    <div><i class="fas fa-cog"></i><span class="p-2"><?= $row1["transmission_type"] ?></span></div>
                                </div>
                                <button type="button" onclick="location.href='vehicle_det.php?id= <?= $id ?>'" class="btn btn-primary gradient-custom ">More Details</button>
                                <?php
                                if ($row1["status"] == 0) { ?>
                                    <button type="button" class="btn btn-outline-danger ver_btn w-50 w-md-auto" data-vehicle-id="<?= $row1["vehicle_id"] ?>">Not verified</button>
                                <?php } else {
                                ?>
                                    <button type="button" class="btn btn-outline-success ver_btn w-50 w-md-auto" data-vehicle-id="<?= $row1["vehicle_id"] ?>">verified</button>
                                <?php
                                }
                                ?>

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
                                <li class="page-item"><a class="page-link" href="admin-cars.php?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                            <?php else : ?>
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <?php endif; ?>

                            <?php for ($page = 1; $page <= $number_of_page; $page++) : ?>
                                <?php if ($page == $current_page) : ?>
                                    <li class="page-item active"><a class="page-link" href="#"><?php echo $page; ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="admin-cars.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($current_page < $number_of_page) : ?>
                                <li class="page-item"><a class="page-link" href="admin-cars.php?page=<?php echo $current_page + 1; ?>">Next</a></li>
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