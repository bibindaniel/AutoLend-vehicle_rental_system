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
    <link rel="stylesheet" href="confrimmodal.css">
</head>
<style>
    .gradient-custom {
        background-color: rgb(2, 0, 36);
        background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
    }
</style>
<script>
    $(document).ready(function() {
        $('.booknver').click(function() {
            $("#modal-btn1").click();
        })
    });
    $(document).ready(function() {
        $("#search-input").on("keyup", function() {
            var searchTerm = $(this).val();
            var status = $('#usrstat').data('usr')
            $.ajax({
                url: "search_ajax.php",
                type: "POST",
                data: {
                    term: searchTerm,
                    status: status
                },
                success: function(response) {
                    $(".row-cols-1").html(response);
                }
            });
        });
    });
    $(document).ready(function() {
        $('.filter-group-btn').on('click', function(e) {
            e.preventDefault();
            $(this).find('.fa-chevron-down, .fa-chevron-up').toggleClass('fa-chevron-down fa-chevron-up');
            $(this).closest('.filter-group').find('form').slideToggle();
        });
        $(document).ready(function() {
            // Function to fetch data and display in results div
            function fetch_data(page) {
                var action = 'fetch_data_ajax';
                var minimum_price = $('.min').val();
                var maximum_price = $('.max').val();
                var brand = get_filter('brand');
                var cat = get_filter('cat');
                var status = $('#usrstat').data('usr');

                // Get current page from URL
                var searchParams = new URLSearchParams(window.location.search);
                var currentPage = searchParams.get('page');

                $.ajax({
                    url: "fetch_data_ajax.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_price: minimum_price,
                        maximum_price: maximum_price,
                        brand: brand,
                        cat: cat,
                        status: status,
                        page: currentPage // Pass current page to server
                    },
                    success: function(data) {
                        $(".row-cols-1").html(data);
                    }
                });
            }


            // Function to get selected filters
            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }
            // Call fetch_data function when any filter is changed
            $('.common_selector').change(function() {
                fetch_data();
            });
        });
    });
</script>
<?php
$tmp_id = $_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$query3 = "SELECT `image`,`user_id` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);
$usr_id = $row3["user_id"];
$query4 = "SELECT * FROM `tbl_verify_user` WHERE `user_id`=$usr_id";
$result4 = mysqli_query($con, $query4);
$row4 = mysqli_fetch_array($result4);
$usr_stat = $row4['verify_status']

?>

<body>
    <?php include "navbar_renter.php"; ?>
    <?php
    $results_per_page = 9;

    //find the total number of results stored in the database  
    $query = "SELECT *FROM `tbl_vehicle` where `status`= 1 AND `Availability`=1 ";
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
    $query = "SELECT *FROM `tbl_vehicle` where `status`= 1 AND `Availability`=1  LIMIT " . $page_first_result . ',' . $results_per_page;
    $result = mysqli_query($con, $query);
    ?>
    <main>
        <input type="hidden" id="usrstat" data-usr="<?= $usr_stat ?>">
        <div class="container m-0">
            <div class="row">
                <aside class="col-md-3">
                    <div class="card">
                        <?php
                        $sql = "SELECT * FROM `tbl_vehicle_category`";
                        $res = mysqli_query($con, $sql);
                        ?>
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true" class="">
                                    <i class="icon-control fa fa-chevron-down filter-group-btn"></i>
                                    <h6 class="title">Product type</h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_3">
                                <form action="">
                                    <div class="card-body">
                                        <?php
                                        while ($cat = mysqli_fetch_array($res)) {
                                        ?>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input common_selector cat" name="cat" value="<?= $cat['category_id'] ?>">
                                                <div class="custom-control-label"><?= $cat['category_name'] ?></div>
                                            </label>
                                        <?php } ?>
                                    </div> <!-- card-body.// -->
                                </form>
                            </div>
                        </article> <!-- filter-group  .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true" class="">
                                    <i class="icon-control fa fa-chevron-down filter-group-btn"></i>
                                    <h6 class="title">Brands </h6>
                                </a>
                            </header>
                            <?php
                            $sql1 = "SELECT DISTINCT `brand_name` FROM `tbl_vehicle` where `status`= 1 AND `Availability`=1 ";
                            $res1 = mysqli_query($con, $sql1);
                            ?>
                            <div class="filter-content collapse show" id="collapse_2">
                                <form>
                                    <div class="card-body">
                                        <?php
                                        while ($brand = mysqli_fetch_array($res1)) {
                                        ?>
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input common_selector brand" name="brand[]" value="<?= $brand['brand_name'] ?>">
                                                <div class="custom-control-label "><?= $brand['brand_name'] ?>
                                                    <b class="badge badge-pill badge-light float-right">120</b>
                                                </div>
                                            </label>
                                        <?php } ?>
                                    </div> <!-- card-body.// -->
                                </form>
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true" class="">
                                    <i class="icon-control fa fa-chevron-down filter-group-btn"></i>
                                    <h6 class="title">Price range </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_3">
                                <form action="">
                                    <div class="card-body">
                                        <!-- <input type="range" class="custom-range" min="0" max="100" name=""> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Min</label>
                                                <input class="form-control common_selector min" placeholder="$500" min="500" type="number">
                                            </div>
                                            <div class="form-group text-right col-md-6">
                                                <label>Max</label>
                                                <input class="form-control common_selector max" placeholder="$1,0000" min="500" type="number">
                                            </div>
                                        </div> <!-- form-row.// -->
                                        <!-- <button class="btn btn-block btn-primary">Apply</button> -->
                                    </div><!-- card-body.// -->
                                </form>
                            </div>
                        </article> <!-- filter-group .// -->

                </aside>
                <main class="col-md-9">
                    <div class="row mt-3 d-flext align-items-start justify-content-end">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for vehicles" id="search-input">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row row-cols-1 row-cols-md-3 mt-4">
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <div class="col mb-4">
                                <div class="card h-100">
                                    <!--Card image-->
                                    <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                                        <img src="vehicle/<?= $row["image1"] ?>" class="w-100 h-100 object-fit-cover" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                                <div class="d-flex justify-content-start align-items-start h-100">
                                                    <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><i class="fa fa-rupee"></i> <?= $row["rate"] ?>/DAY</span></h5>
                                                </div>
                                            </div>
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>

                                    <!--Card content-->
                                    <div class="card-body">
                                        <div class="d-flex flex-row justify-content-center mt-1">
                                            <a href="" class="text-reset">
                                                <h5 class="card-title mb-3"><?= $row["brand_name"] ?> <?= $row["model_name"] ?></h5>
                                            </a>
                                        </div>
                                        <div class="text-center mb-2"><i class='fas fa-map-marker-alt'></i><span class="p-2"><?= $row["location"] ?></span></div>
                                        <div class="d-flex flex-row justify-content-center mt-1 mb-4 text-danger">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <?php $id = $row["vehicle_id"] ?>
                                        <div class="d-flex flex-row justify-content-center mt-1">
                                            <?php
                                            if ($row4['verify_status'] == 1) {
                                            ?>
                                                <button type="button" onclick="location.href='vehicle_det_usr.php?id= <?= $id ?>'" class="btn btn-primary gradient-custom ">BOOK NOW</button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" id="booknver" class="btn btn-primary gradient-custom booknver">BOOK NOW</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Close the card element -->
                            </div>
                        <?php } ?>
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
            </div>
        </div>
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
                    <h4 class="modal-title w-100">Verify your Account!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Go to <a href="userprofile.php">user profile</a> then click verify user and update your details to book vehicle </p>
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