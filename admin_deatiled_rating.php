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
    $vid = $_GET['id'];
    ?>
    <!--Main Navigation-->
    <?php
    include("adminsidebar.php");
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="row">
                <?php
                $sql2 = "SELECT tbl_review.*,tbl_user.* from tbl_review JOIN tbl_user on tbl_review.user_id=tbl_user.login_id WHERE  tbl_review.vehicle_id=$vid";
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
                                    <?php
                                     $overall_rating=($rev["Accuracy"]+$rev["Cleanliness"]+$rev["Communication"]+$rev["Vehicle_Condition"])/4;
                                    ?>
                                    <small class="text-muted">Rated <?=$overall_rating?>/5</small>
                                </div>
                                <hr>
                                <p class="card-text"><?= $rev["review_msg"] ?></p>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Accuracy:</td>
                                            <td><?= $rev["Accuracy"] ?>/5</td>
                                        </tr>
                                        <tr>
                                            <td>Cleanliness:</td>
                                            <td><?= $rev["Cleanliness"] ?>/5</td>
                                        </tr>
                                        <tr>
                                            <td>Communication:</td>
                                            <td><?= $rev["Communication"] ?>/5</td>
                                        </tr>
                                        <tr>
                                            <td>Vehicle Condition:</td>
                                            <td><?= $rev["Vehicle_Condition"] ?>/5</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                ?>
            </div>

    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>