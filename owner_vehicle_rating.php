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
    <main style="margin-top: 58px">
        <div class="container pt-4">
        <?php
            $results_per_page = 3;

            //find the total number of results stored in the database  
            $query = "SELECT * FROM `tbl_vehicle` WHERE `user_id`=$tmp_id AND`status`=1";
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
            $query = "SELECT * FROM `tbl_vehicle` WHERE `user_id`=$tmp_id AND`status`=1
LIMIT " . $page_first_result . "," . $results_per_page;
            $result1 = mysqli_query($con, $query);
            $count = mysqli_num_rows($result1)
            ?>
            <section>
                <div class="container py-5">
                    <h4 class="text-center mb-5"><strong>Cars Ratings</strong></h4>

                    <div class="row">
                        <?php
                        while ($row1 = mysqli_fetch_array($result1)) { ?>
                            <div class="col-lg-4 col-md-12 mb-4">
                                <div class="card">
                                    <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                                        <img src="vehicle/<?= $row1["image1"] ?>" class="w-100 h-100 object-fit-cover" />
                                        <a href="owner_detailed_rating.php?id=<?=$row1['vehicle_id']?>">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                                <div class="d-flex justify-content-start align-items-start h-100">
                                                    <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><i class="fa fa-rupee"></i> <?= $row1["rate"] ?></span></h5>
                                                </div>
                                            </div>
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center mt-3">
                                            <a href="" class="text-reset">
                                                <h5 class="card-title mb-3"><?= $row1["brand_name"] ?> <?= $row1["model_name"] ?></h5>
                                            </a>
                                        </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
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
                    <li class="page-item"><a class="page-link" href="owner_vehicle_rating.php?page=<?php echo $current_page - 1; ?>">Previous</a></li>
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
                        <li class="page-item"><a class="page-link" href="owner_vehicle_rating.php?page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($max_links < $number_of_page) : ?>
                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                <?php endif; ?>

                <?php if ($current_page < $number_of_page) : ?>
                    <li class="page-item"><a class="page-link" href="owner_vehicle_rating.php?page=<?php echo $current_page + 1; ?>">Next</a></li>
                <?php else : ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>