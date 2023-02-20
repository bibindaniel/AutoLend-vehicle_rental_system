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
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<style>
    .image--cover {
        width: 150px;
        height: 150px;
        border-radius: 50%;
    }
</style>
<?php
$tmp_id = $_SESSION['id'];
$con = mysqli_connect("localhost", "root", "", "mini-prj");
$query = "SELECT * FROM `tbl_user` WHERE `login_id`='$tmp_id'";
$result = mysqli_query($con, $query);
$query1 = "SELECT * FROM `tbl_login` WHERE `login_id`='$tmp_id'";
$result2 = mysqli_query($con, $query1);
$row = mysqli_fetch_array($result);
$row2 = mysqli_fetch_array($result2);
?>

<body>
    <section class="vh-100 gradient-form" style="background-color: #f4f5f7;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4 ">
                        <ol class="breadcrumb mb-0 ">
                            <li class="breadcrumb-item"><a href="lpage.php">Home</a></li>
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
                                    <!-- <h6>verify profile</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">

                                        </div> -->
                                    <h6></h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <button type="button" class="btn btn-outline-primary" id="btn" data-mdb-ripple-color="dark" data-toggle="modal" data-target="#exampleModal">verify user</button>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark">Delete Account</button>
                                        </div>
                                    </div>
                                    <!-- <div class="d-flex justify-content-start">
                                        <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                        <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    poda
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#btn").click(function() {
            $('#exampleModal').modal('toggle')
        })
        $("#btn-close").click(function() {
            $('#exampleModal').modal('hide')
        })
    })
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</html>