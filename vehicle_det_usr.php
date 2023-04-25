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
    <link rel="stylesheet" href="confrimmodal.css">
</head>
<style>
    .gradient-custom {
        background-color: rgb(2, 0, 36);
        background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
    }

    .green_clr {
        background-color: #203740;
    }

    .btn {
        width: 100%;
        height: 55px;
        border-radius: 0;
        padding: 13px 0;
        border: none;
        font-weight: 600;
    }

    .btn.btn-primary:hover {
        transform: translateX(10px);
        transition: transform 0.5s ease
    }

    .carousel-item>img {
        min-height: 447px;
        max-height: 447px;
    }

    select {
        width: 100%;
        max-width: 300px;
    }
</style>
<script>
    $(document).ready(function() {
        var today = new Date().toISOString().split('T')[0];
        $('#stdate').attr('min', today);
        $('#endate').attr('min', today);
        $("#stdate").on("change", function() {
            var startDate = $(this).val();
            $("#endate").attr("min", startDate);
        });
        $('#bookbtn').click(function() {
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
    });
    $(document).ready(function() {
        $("#stdate").on("change", function() {
            var start_date = $(this).val();
            var vid = $('#btn1').data('vehicle-id')
            $.ajax({
                url: "check_dates.php",
                type: "POST",
                data: {
                    start_date: start_date,
                    vehicleID: vid
                },
                dataType: "json",
                success: function(result) {
                    if (result.status === "error") {
                        $("#modal-btn2").click();
                        $("#stdate").val("");
                    } else {
                        $("#stdate1").text("");
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.rating').each(function() {
            var rating = $(this);
            var input = rating.find('input');
            var value = input.val();
            var icons = rating.find('i');

            icons.on('click', function() {
                value = $(this).attr('data-value');
                input.val(value);
                icons.each(function() {
                    if ($(this).attr('data-value') <= value) {
                        $(this).removeClass('far').addClass('fas');
                    } else {
                        $(this).removeClass('fas').addClass('far');
                    }
                });
            });

            icons.hover(function() {
                var hoverValue = $(this).attr('data-value');
                icons.each(function() {
                    if ($(this).attr('data-value') <= hoverValue) {
                        $(this).removeClass('far').addClass('fas');
                    } else {
                        $(this).removeClass('fas').addClass('far');
                    }
                });
            }, function() {
                icons.each(function() {
                    if ($(this).attr('data-value') <= value) {
                        $(this).removeClass('far').addClass('fas');
                    } else {
                        $(this).removeClass('fas').addClass('far');
                    }
                });
            });
        });
    });
</script>


<?php
$tmp_id = $_SESSION['id'];
include 'dbconnect.php';
$query3 = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);
?>

<body>
    <?php
    include "navbar_renter.php";
    $id = $_GET["id"];
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
    $query3 = "SELECT * FROM `tbl_available_time` WHERE `vehicle_id` =$id";
    $result3 = mysqli_query($con, $query3);
    $query4 = "SELECT * FROM `tbl_available_time` WHERE `vehicle_id` =$id";
    $result4 = mysqli_query($con, $query4);
    $sql = "SELECT * FROM `tbl_request_vehicle` WHERE `user_id`=$tmp_id AND `vehicle_id`=$id";
    $result5 = mysqli_query($con, $sql);
    $req = mysqli_fetch_array($result5);
    $sql2 = "SELECT start_date,end_date FROM tbl_request_vehicle
    UNION
    SELECT start_date,end_date FROM tbl_vehicle_booking";
    $result6 = mysqli_query($con, $sql2);
    $blocked_dates = array();

    while ($row7 = mysqli_fetch_assoc($result6)) {
        $blocked_dates[] = $row;
    }

    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow m-4">
                    <div class="row no-gutters">
                        <div class="row">
                            <div class="col-md-7 m-3">
                                <div class="container-fluid p-0">
                                    <div id="carouselExampleCrossfade" class="carousel slide" data-mdb-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-mdb-target="#carouselExampleCrossfade" data-mdb-slide-to="2" aria-label="Slide 3"></button>
                                            <button type="button" data-mdb-target="#carouselExampleIndicators" data-mdb-slide-to="3" aria-label="Slide 4"></button>
                                        </div>
                                        <div class="carousel-inner rounded-5 shadow-4-strong">
                                            <div class="carousel-item active">
                                                <img src="vehicle/<?= $row["image1"] ?>" class="d-block w-100 " alt="Wild Landscape" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/<?= $row["image2"] ?>" class="d-block w-100" alt="Camera" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/<?= $row["image3"] ?>" class="d-block w-100" alt="Exotic Fruits" />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="vehicle/<?= $row["image4"] ?>" class="d-block w-100" alt="Exotic Fruits" />
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
                                    <div class="d-flex align-items-end px-2 mt-4 mb-2">
                                        <p class="h4 m-0"><span class="pe-1"><?= $row["brand_name"] ?></span><span class="pe-1"><?= $row["model_name"] ?></span><span class="pe-1"><?= $row["year"] ?></span></p> 
                                    </div>
                                    <div class="mt-1 h5"><i class="fa fa-rupee"></i> <?= $row["rate"] ?>/DAY</div>
                                    <div class="d-flex align-items-center  mt-3 mb-2">
                                        <p class="text-dark"><?= $row["Features"] ?> </p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class="fa-solid fa-gears"></i><span class="m-2"><?= $row["transmission_type"] ?></span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-oil-can'></i><span class="m-2"><?= $row["mileage"] ?></span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-gas-pump'></i><span class="m-2"><?= $row["fuel_type"] ?></span></p>
                                    </div>

                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-car-side'></i><span class="m-2"><?= $row2["category_name"] ?></span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-thumbtack'></i><span class="m-2"><?= $row["location"] ?></span></p>
                                    </div>
                                    <div class="col-md-4 col-6 ps-30 pe-0 my-2">
                                        <p><i class='fas fa-couch'></i><span class="m-2"><?= $row["seat"] ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 card shadow">
                    <div class="title">
                        <p class="fw-bold text-center">Owner Details</p>
                    </div>
                    <div class="card-body  text-center">
                        <img src="Uploads/<?= $row1["image"] ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height:150px">
                        <h5 class="my-3"><?= $row1["first_name"] ?></h5>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="mailto:"><i class="fas fa-envelope"></i></a><?= $row1["email"] ?>
                            </div>
                            <div class="col-md-12">
                                <a href="tel:"><i class="fas fa-phone"></i></a><?= $row1["mobile"] ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                        </div>
                    </div>
                </div>
                <div class="col-md-8 card">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="d-flex align-items-center justify-content-center px-4 mt-4 mb-2">
                            <p class="h4 m-0"><span class="pe-1">MAKE</span><span class="pe-1">YOUR</span><span class="pe-1">TRIP</span></p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <div class="form-outline">
                                    <input type="text" id="Location1" name="loc1" class="form-control form-control-lg" maxlength="40" required />
                                    <label class="form-label" for="Location1">DROP IN</label>
                                </div>
                                <div class="wr-msg text-danger" id="Location1"></div>
                            </div>
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <select class="select form-control-lg" id="sttime" name="sttime" required>
                                    <?php
                                    while ($row3 = mysqli_fetch_array($result3)) {
                                    ?>
                                        <option value="<?= $row3["time"] ?>"><?= $row3["time"] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="wr-msg text-danger" id="sttime1"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <div class="form-outline">
                                    <input type="text" id="Location2" name="loc2" class="form-control form-control-lg" required />
                                    <label class="form-label" for="Location2">DROP OFF</label>
                                </div>
                                <div class="wr-msg text-danger" id="Location1"></div>
                            </div>
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <select class="select form-control-lg" id="entime" name="entime" required>
                                    <?php
                                    while ($row4 = mysqli_fetch_array($result4)) {
                                    ?>
                                        <option value="<?= $row4["time"] ?>"><?= $row4["time"] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="wr-msg text-danger" id="entime1"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="d-flex align-items-end px-5  pb-1 mx-5">
                                <p class="h6 m-0"><span class="pe-1 px-5 mx-4">RENTAL PERIOD</span></p>
                            </div>
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <div class="form-outline">
                                    <input type="date" id="stdate" name="stdate" min='2023-03-01' class="form-control form-control-lg" onkeydown="return false" required />
                                    <label class="form-label" for="stdate">START DATE</label>
                                </div>
                                <div class="wr-msg text-danger" id="stdate1"></div>
                            </div>
                            <div class="col-md-4 mb-4 m-4 mt-1">
                                <div class="form-outline">
                                    <input type="date" id="endate" name="endate" min='2023-03-01' class="form-control form-control-lg" onkeydown="return false" required />
                                    <label class="form-label" for="endate">END DATE</label>
                                </div>
                                <div class="wr-msg text-danger" id="endate1"></div>
                            </div>
                        </div>
                        <div class="row justify-content-center px-5">
                            <div class="col-md-4 mb-4 m-4 px-5 mt-1">
                                <?php
                                if (mysqli_num_rows($result5) == 0) {
                                ?>
                                    <button type="submit" class=" btn btn-success green_clr" id="bookbtn" name="sub">BOOK NOW</button>

                                <?php
                                } else if ($req['request_status'] == 2) {
                                ?>
                                    <button type="submit" class=" btn btn-success green_clr" id="bookbtn" name="sub">Booked</button>

                                <?php
                                } else if ($req['request_status'] == 1 || $req['request_status'] == 0) {
                                ?>
                                    <button type="submit" class=" btn btn-success green_clr" id="bookbtn" name="sub">Requested</button>
                                <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" name="hidden" id="hid" data-user-id="<?= $tmp_id ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql1 = "SELECT * FROM `tbl_review` WHERE `vehicle_id`='$id'";
    $res1 = mysqli_query($con, $sql1);
    $accuracy_total = 0;
    $cleanliness_total = 0;
    $communication_total = 0;
    $vehicle_condition_total = 0;

    $count = mysqli_num_rows($res1);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res1)) {
            $accuracy_total += $row['Accuracy'];
            $cleanliness_total += $row['Cleanliness'];
            $communication_total += $row['Communication'];
            $vehicle_condition_total += $row['Vehicle_Condition'];
        }

        $accuracy_avg = $accuracy_total / $count;
        $cleanliness_avg = $cleanliness_total / $count;
        $communication_avg = $communication_total / $count;
        $vehicle_condition_avg = $vehicle_condition_total / $count;

        $accuracy_percent = $accuracy_avg * 20;
        $cleanliness_percent = $cleanliness_avg * 20;
        $communication_percent = $communication_avg * 20;
        $vehicle_condition_percent = $vehicle_condition_avg * 20;

    ?>
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Reviews</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Accuracy</h5>
                        <div class="progress" style="height: 15%;">
                            <div class="progress-bar" role="progressbar" style="width: <?= $accuracy_percent ?>%;" aria-valuenow="<?= $accuracy_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $accuracy_percent ?>%</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Cleanliness</h5>
                        <div class="progress" style="height: 15%;">
                            <div class="progress-bar" role="progressbar" style="width: <?= $cleanliness_percent ?>%;" aria-valuenow="<?= $cleanliness_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $cleanliness_percent ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h5>Communication</h5>
                        <div class="progress" style="height: 15%;">
                            <div class="progress-bar" role="progressbar" style="width: <?= $communication_percent ?>%;" aria-valuenow="<?= $communication_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $communication_percent ?>%</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Vehicle condition</h5>
                        <div class="progress" style="height: 15%;">
                            <div class="progress-bar" role="progressbar" style="width: <?= $vehicle_condition_percent ?>%;" aria-valuenow="<?= $vehicle_condition_percent ?>" aria-valuemin="0" aria-valuemax="100"><?= $vehicle_condition_percent ?>%</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <?php
                    $sql2 = "SELECT tbl_review.*,tbl_user.* from tbl_review JOIN tbl_user on tbl_review.user_id=tbl_user.login_id WHERE `vehicle_id`='$id' limit 4";
                    $res2 = mysqli_query($con, $sql2);
                    while ($rev = mysqli_fetch_array($res2)) {
                    ?>
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img src="Uploads/<?= $rev["image"] ?>" class="rounded-circle me-3" alt="User profile image" style="width: 50px; height:50px">
                                            <h5 class="card-title mb-0"><?= $rev["first_name"] ?></h5>
                                        </div>
                                        <small class="text-muted">Rated 4.5/5</small>
                                    </div>
                                    <hr>
                                    <p class="card-text"><?= $rev["review_msg"] ?></p>
                                    <div class="d-flex justify-content-between">
                                        <small class="text-muted"><?= $rev["review_date"] ?></small>
                                        <div>
                                            <a href="#" class="me-2"><i class="far fa-thumbs-up"></i></a>
                                            <a href="#"><i class="far fa-thumbs-down"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <section class="p-5 text-center">
                        <h2>No rating or review available</h2>
                    </section>
                <?php
                }
                ?>
                </div>
                <?php
                $sql = "SELECT * FROM `tbl_vehicle_booking` WHERE `user_id`=$tmp_id AND`booking_status`=3 AND `vehicle_id`=$id";
                $res = mysqli_query($con, $sql);
                $count = mysqli_num_rows($res);
                if ($count >= 1) {
                ?>
                    <div class="col-md-12 mb-4 d-flex align-items-center justify-content-center">
                        <div class="text-center mt-4">
                            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#reviewModal">
                                Rate this car
                            </button>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- Modal -->
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="reviewModalLabel">Rate Your Experience</h5>
                                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" method="POST">
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <label for="accuracy" class="form-label">Accuracy</label>
                                            </div>
                                            <div class="col-6">
                                                <div class="rating">
                                                    <input type="hidden" name="accuracy_rating_value" id="accuracy_rating_value" value="0" required>
                                                    <div class="rating-icons">
                                                        <i class="far fa-angry fa-lg" style="color: #673ab7" data-value="1"></i>
                                                        <i class="far fa-frown fa-lg" style="color: #3f51b5" data-value="2"></i>
                                                        <i class="far fa-meh fa-lg" style="color: #2196f3" data-value="3"></i>
                                                        <i class="far fa-smile fa-lg" style="color: #03a9f4" data-value="4"></i>
                                                        <i class="far fa-grin-stars fa-lg" style="color: #00bcd4" data-value="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <label for="cleanliness" class="form-label">Cleanliness</label>
                                            </div>
                                            <div class="col-6">
                                                <div class="rating">
                                                    <input type="hidden" name="cleanliness_rating_value" id="cleanliness_rating_value" value="0" required>
                                                    <div class="rating-icons">
                                                        <i class="far fa-angry fa-lg" style="color: #673ab7" data-value="1"></i>
                                                        <i class="far fa-frown fa-lg" style="color: #3f51b5" data-value="2"></i>
                                                        <i class="far fa-meh fa-lg" style="color: #2196f3" data-value="3"></i>
                                                        <i class="far fa-smile fa-lg" style="color: #03a9f4" data-value="4"></i>
                                                        <i class="far fa-grin-stars fa-lg" style="color: #00bcd4" data-value="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <label for="communication" class="form-label">Communication</label>
                                            </div>
                                            <div class="col-6">
                                                <div class="rating">
                                                    <input type="hidden" name="communication_rating_value" id="communication_rating_value" value="0" required>
                                                    <div class="rating-icons">
                                                        <i class="far fa-angry fa-lg" style="color: #673ab7" data-value="1"></i>
                                                        <i class="far fa-frown fa-lg" style="color: #3f51b5" data-value="2"></i>
                                                        <i class="far fa-meh fa-lg" style="color: #2196f3" data-value="3"></i>
                                                        <i class="far fa-smile fa-lg" style="color: #03a9f4" data-value="4"></i>
                                                        <i class="far fa-grin-stars fa-lg" style="color: #00bcd4" data-value="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <label for="vehicle-condition" class="form-label">Vehicle Condition</label>
                                            </div>
                                            <div class="col-6">
                                                <div class="rating">
                                                    <input type="hidden" name="vehicle-condition_rating_value" id="vehicle-condition_rating_value" value="0" required>
                                                    <div class="rating-icons">
                                                        <i class="far fa-angry fa-lg" style="color: #673ab7" data-value="1"></i>
                                                        <i class="far fa-frown fa-lg" style="color: #3f51b5" data-value="2"></i>
                                                        <i class="far fa-meh fa-lg" style="color: #2196f3" data-value="3"></i>
                                                        <i class="far fa-smile fa-lg" style="color: #03a9f4" data-value="4"></i>
                                                        <i class="far fa-grin-stars fa-lg" style="color: #00bcd4" data-value="5"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="review-text" class="form-label">Write a Review</label>
                                        <textarea class="form-control" name="reviewmsg" id="review-text" rows="3" required></textarea>
                                    </div>

                            </div>
                            <div class="modal-footer row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                    <button type="submit" name="revsub" class="btn btn-primary">Submit Review</button>
                                </div>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>

        </section>


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
        <button type="button" id="modal-btn2" style="display:none;" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#dateModal">
            Launch demo modal
        </button>
        <!-- Modal del -->
        <div id="dateModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box" style="background-color:#fa0000;">
                            <i class="fa fa-times fa-3x"></i>
                        </div>
                        <h4 class="modal-title w-100">Oops!</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">"The vehicle is already booked on this day. Please choose other dates!"</p>
                    </div>
                    <div class="modal-footer d-grid d-md-flex justify-content-center">
                        <button type="button" id="btn1" data-vehicle-id="<?= $id ?>" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
</body>
<?php
if (isset($_POST["revsub"])) {
    $accur = $_POST["accuracy_rating_value"];
    $clean = $_POST["cleanliness_rating_value"];
    $commu = $_POST["communication_rating_value"];
    $vehcon = $_POST["vehicle-condition_rating_value"];
    $msg = $_POST["reviewmsg"];
    $query5="SELECT * FROM `tbl_review` WHERE `user_id`=$tmp_id AND `vehicle_id`=$id";
    $res5=mysqli_query($con, $query5);
    $no=mysqli_num_rows($res5);
    if($no<1){
        $query = "INSERT INTO `tbl_review`(`Accuracy`, `Cleanliness`, `Communication`, `Vehicle_Condition`, `review_msg`, `user_id`,`vehicle_id`) VALUES ('$accur',' $clean',' $commu','$vehcon','$msg','$tmp_id','$id')";
        $result = mysqli_query($con, $query);
    }else{
        $query="UPDATE `tbl_review` SET `Accuracy`='$accur',`Cleanliness`='$clean',`Communication`='$commu',`Vehicle_Condition`='$vehcon',`review_msg`='$msg' WHERE `user_id`=$tmp_id AND `vehicle_id`=$id ";
        $result = mysqli_query($con, $query);
    }
    echo "<script>window.location.href = 'search-cars.php';</script>";
}
?>
<?php
if (isset($_POST["sub"])) {
    $dinloc = $_POST["loc1"];
    $dofloc = $_POST["loc2"];
    $dintime = $_POST["sttime"];
    $doftime = $_POST["entime"];
    $stdate = $_POST["stdate"];
    $enddate = $_POST["endate"];
    $exists_query = "SELECT * FROM `tbl_request_vehicle` WHERE `vehicle_id`='$id' AND `user_id`='$tmp_id'";
    $exists_result = mysqli_query($con, $exists_query);
    if ($exists_result && mysqli_num_rows($exists_result) > 0) {
        // Request already exists, do nothing
    } else {
        $query = "INSERT INTO `tbl_request_vehicle`(`vehicle_id`, `user_id`, `start_date`, `end_date`, `drop_in_location`, `drop_in_time`, `drop_of_location`, `drop_of_time`) VALUES ('$id','$tmp_id','$stdate','$enddate','$dinloc','$dintime','$dofloc','$doftime')";
        $result = mysqli_query($con, $query);
        $query = "UPDATE `tbl_vehicle` SET `booking_status`='Requested' WHERE `vehicle_id`=$id";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<script>location.href='view_request_vehicle.php'</script>";
?>
            <script>
                $(document).ready(function() {
                    $("#bookbtn").text('REQUESTED')
                })
            </script>
<?php
        }
    }
}
?>
<script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

</html>