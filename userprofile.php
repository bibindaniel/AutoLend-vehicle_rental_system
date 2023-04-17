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
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="registrationstyle.css">
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <!-- icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<style>
    .image--cover {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }

    .modal-confirm {
        color: #636363;
        width: 400px;
    }

    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }

    .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }

    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }

    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }

    .modal-confirm .modal-body {
        color: #999;
    }

    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }

    .modal-confirm .modal-footer a {
        color: #999;
    }

    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }

    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }

    .modal-confirm .btn,
    .modal-confirm .btn:active {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
    }

    .modal-confirm .btn-secondary {
        background: #c1c1c1;
    }

    .modal-confirm .btn-secondary:hover,
    .modal-confirm .btn-secondary:focus {
        background: #a8a8a8;
    }

    .modal-confirm .btn-danger {
        background: #f15e5e;
    }

    .modal-confirm .btn-danger:hover,
    .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
</style>
<?php
$tmp_id = $_SESSION['id'];
include 'dbconnect.php';
$query = "SELECT * FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$query1 = "SELECT * FROM `tbl_login` WHERE `login_id`='$tmp_id'";
$result2 = mysqli_query($con, $query1);
$row2 = mysqli_fetch_array($result2);
$id = $row['user_id'];
$query3 = "SELECT * FROM `tbl_verify_user` WHERE `user_id`='$id'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);
?>

<body>
    <section class="vh-100 gradient-form" style="background-color: #f4f5f7;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 ">
                        <ol class="breadcrumb mb-0 ">
                            <?php if ($row["user_type"]==1) { ?>
                                <li class="breadcrumb-item"><a href="lpage.php">Home</a></li> 
                            <?php } else{?>
                            <li class="breadcrumb-item"><a href="l-car-owner-page.php">Home</a></li>
                            <?php }?>
                            <!-- <li class="breadcrumb-item"><a href="#">User</a></li> -->
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card rounded-2 text-black">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="Uploads/<?php echo $row['image'] ?>" alt="Avatar" class="image--cover img-fluid my-5" style="width: 150px" />
                                <h5><?php echo $row['first_name'] ?></h5>
                                <p><?php echo $row2['user_name'] ?></p>
                                <a href="userprofileedit.php"><i class="far fa-edit mb-5 text-white"></i></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted"><?php echo $row['email'] ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted"><?php echo $row['mobile'] ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>DOB</h6>
                                            <p class="text-muted"><?php echo $row['dob'] ?></p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Location</h6>
                                            <p class="text-muted"><?php echo $row['location'] ?></p>
                                        </div>
                                    </div>
                                    <h6></h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                    <?php if($row["user_type"]==1) { ?>
                                        <div class="col-6 mb-3">
                                            <?php
                                            $status = $row3["verify_status"];
                                            if ($status == -1) {
                                                echo " <button type='button' class='btn btn-outline-primary' id='btn' data-mdb-ripple-color='dark' data-toggle='modal' data-target='#exampleModal'>verify user</button>";
                                            } elseif ($status == 0) {
                                                echo " <button type='button' class='btn btn-outline-info' id='btn' data-mdb-ripple-color='dark' data-toggle='modal' data-target='#exampleModal' disabled>verification pending</button>";
                                            } else {
                                                echo " <button type='button' class='btn btn-outline-success' id='btn' data-mdb-ripple-color='dark' data-toggle='modal' data-target='#exampleModal' disabled>verified</button>";
                                            }
                                            ?>
                                        </div>
                                        <?php } ?>
                                        <div class="col-6 mb-3">
                                            <button type="button" id="btn2" class="btn btn-outline-danger" data-mdb-ripple-color="dark">Delete Account</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user verifiation modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verify your licence</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="form">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <div class="form-outline">
                                        <input type="text" id="licenceno" name="lno" class="form-control form-control-lg" value="" />
                                        <label class="form-label" for="licenceno">Licence No</label>
                                    </div>
                                    <div class="wr-msg" id="licenceno1"></div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="form-outline">
                                    <input type="date" id="expirydate" name="exdate" class="form-control form-control-lg" value="" min='2020-01-01' />
                                    <label class="form-label" for="expirydate">Expiry Date</label>
                                </div>
                                <div class="wr-msg" id="expirydate1"></div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="licenceimg">Upload licence(.pdf format)</label>
                                <div class="form-outline">
                                    <input type="file" id="licenceimg" name="limg" class="form-control form-control-lg" value="" accept=".pdf" onchange="fileValidation()" />
                                </div>
                                <div class="wr-msg" id="DOB1"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn1" name="sub" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["sub"])) {
        $lno = $_POST["lno"];
        $exdate = $_POST["exdate"];
        $limg =  $_FILES['limg']['name'];
        $uid = $row["user_id"];
        $query1 = "UPDATE `tbl_verify_user` SET `verify_status`='0',`licence_no`='$lno',`Expiry_date`='$exdate',`licence_file`='$limg' WHERE  `user_id`='$id'";
        $result3 = mysqli_query($con, $query1);
        $target = "Licence/";
        $targetfilepath = $target . $limg;
        move_uploaded_file($_FILES['limg']['tmp_name'], $targetfilepath);
        if ($result3) {
    ?>
            <script>
                location.href = 'userprofile.php'
            </script>
    <?php

        }
    }
    ?>
    <!-- account delete conformation modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="d-grid d-md-flex justify-content-md-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete this account?</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="userverification.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>