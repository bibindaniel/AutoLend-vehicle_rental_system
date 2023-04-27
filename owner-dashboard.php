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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
</head>

<body>
    <style>
        .counter {
            color: #eb3b5a;
            font-family: 'Muli', sans-serif;
            width: 200px;
            height: 200px;
            text-align: center;
            border-radius: 100%;
            padding: 77px 32px 40px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .counter:before,
        .counter:after {
            content: "";
            background: #fff;
            width: 80%;
            height: 80%;
            border-radius: 100%;
            box-shadow: -5px 5px 5px rgba(0, 0, 0, 0.3);
            transform: translateX(-50%)translateY(-50%);
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: -1;
        }

        .counter:after {
            background: linear-gradient(45deg, #B81242 49%, #D74A75 50%);
            width: 100%;
            height: 100%;
            box-shadow: none;
            transform: translate(0);
            top: 0;
            left: 0;
            z-index: -2;
            clip-path: polygon(50% 50%, 50% 0, 100% 0, 100% 100%, 0 100%, 0 50%);
        }

        .counter .counter-icon {
            color: #fff;
            background: linear-gradient(45deg, #B81242 49%, #D74A75 50%);
            font-size: 33px;
            line-height: 70px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            transition: all 0.3s;
        }

        .counter .counter-icon i.fa {
            transform: rotateX(0deg);
            transition: all 0.3s ease 0s;
        }

        .counter:hover .counter-icon i.fa {
            transform: rotateX(360deg);
        }

        .counter h3 {
            font-size: 17px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 3px;
        }

        .counter .counter-value {
            font-size: 30px;
            font-weight: 700;
        }

        .counter.orange {
            color: #F38631;
        }

        .counter.orange:after,
        .counter.orange .counter-icon {
            background: linear-gradient(45deg, #F38631 49%, #F8A059 50%);
        }

        .counter.green {
            color: #88BA1B;
        }

        .counter.green:after,
        .counter.green .counter-icon {
            background: linear-gradient(45deg, #88BA1B 49%, #ACD352 50%);
        }

        .counter.blue {
            color: #5DB3E4;
        }

        .counter.blue:after,
        .counter.blue .counter-icon {
            background: linear-gradient(45deg, #5DB3E4 49%, #7EBEE1 50%);
        }

        .counter.red {
            color: #FF7F7F;
        }

        .counter.red:after,
        .counter.red .counter-icon {
            background: linear-gradient(45deg, #FF7F7F 49%, #FFAFAF 50%);
        }

        @media screen and (max-width:990px) {
            .counter {
                margin-bottom: 40px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.counter-value').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3500,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    </script>
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
    <!--Main Navigation-->
    <?php
    $query1 = "SELECT * FROM `tbl_vehicle` WHERE `user_id` =  $tmp_id";
    $result1 = mysqli_query($con, $query1);
    $count = mysqli_num_rows($result1);
    $query1 = "SELECT * FROM `tbl_vehicle` WHERE `user_id` =  $tmp_id";
    $result1 = mysqli_query($con, $query1);
    $count2 = mysqli_num_rows($result1);
    $query3 = "SELECT COUNT(*) as total_bookings
            FROM tbl_vehicle_booking b
            JOIN tbl_vehicle v ON b.vehicle_id = v.vehicle_id
            WHERE v.user_id = $tmp_id";
    $result3 = mysqli_query($con, $query3);
    $row = mysqli_fetch_array($result3);
    $query = "SELECT SUM(amount) as total_revenue,SUM(amount) / COUNT(DISTINCT tbl_vehicle_booking.booking_id) as avg_revenue
    FROM tbl_payment
    JOIN tbl_vehicle_booking ON tbl_payment.request_id = tbl_vehicle_booking.booking_id 
    JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id = tbl_vehicle.vehicle_id
    WHERE tbl_vehicle.user_id = 21";
    $result = mysqli_query($con, $query);
    $rev = mysqli_fetch_array($result);
    $total_revenue = $rev['total_revenue'];
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 my-4">
                        <div class="counter blue">
                            <div class="counter-icon">
                                <i class="fa fa-car"></i>
                            </div>
                            <h3>Total Cars</h3>
                            <span class="counter-value"><?= $count ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-auto">
                        <div class="counter green">
                            <div class="counter-icon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <h3>Total Bookings</h3>
                            <span class="counter-value"><?= $row['total_bookings'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-auto">
                        <div class="counter orange">
                            <div class="counter-icon">
                                <i class="fa fa-rupee"></i>
                            </div>
                            <h3>Average Revenue</h3>
                            <span class="counter-value"><?= $rev['avg_revenue'] ?></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-auto">
                        <div class="counter red">
                            <div class="counter-icon">
                                <i class="fa fa-rupee"></i>
                            </div>
                            <h3>Total Revenue</h3>
                            <span class="counter-value"><?= $rev['total_revenue'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container m-3">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-8">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    $sql = "SELECT tbl_vehicle.model_name 
    FROM tbl_payment 
    JOIN tbl_vehicle_booking ON tbl_payment.request_id = tbl_vehicle_booking.booking_id 
    JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id = tbl_vehicle.vehicle_id 
    WHERE tbl_vehicle.user_id = 21 
    GROUP BY tbl_vehicle.vehicle_id 
    ORDER BY SUM(tbl_payment.amount) DESC limit 6";
    $result = mysqli_query($con, $sql);
    $vehicles = array();

    // Fetch the result row by row and add to the array
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $vehicles[] = $row['model_name'];
    }
    $sql = "SELECT SUM(tbl_payment.amount) as revenue FROM tbl_payment JOIN tbl_vehicle_booking ON tbl_payment.request_id = tbl_vehicle_booking.booking_id JOIN tbl_vehicle ON tbl_vehicle_booking.vehicle_id = tbl_vehicle.vehicle_id WHERE tbl_vehicle.user_id = 21 GROUP BY tbl_vehicle.vehicle_id ORDER BY revenue DESC limit 6";
    $result = mysqli_query($con, $sql);
    $revenue = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $revenue[] = $row['revenue'];
    }
    ?>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($vehicles) ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($revenue) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>