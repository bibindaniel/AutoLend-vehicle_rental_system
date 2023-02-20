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
    .container {
        max-width: 960px;
        margin: 30px auto;
        padding: 20px;
    }

    h1 {
        font-size: 20px;
        text-align: center;
        margin: 20px 0 20px;
    }

    h1 small {
        display: block;
        font-size: 15px;
        padding-top: 8px;
        color: gray;
    }

    .avatar-upload {
        position: relative;
        max-width: 205px;
        margin: 50px auto;
    }

    .avatar-upload .avatar-edit {
        position: absolute;
        z-index: 1;

    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f040";
        font-family: 'FontAwesome';
        color: #757575;
        position: absolute;

        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 192px;
        height: 192px;
        position: relative;
        border-radius: 100%;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
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
                            <li class="breadcrumb-item"><a href="userprofile.php">User profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile update</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="card rounded-2 text-black">
                            <div class="row g-0">
                                <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                    <div class="container">
                                        <h1>Change profile picture</h1>
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="myimage" onchange="fileValidation()" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url('Uploads/<?php echo $row['image'] ?>');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-4">
                                        <h6>Information</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="text" id="firstName" name="fname" class="form-control form-control-lg" value="<?php echo $row['first_name'] ?>" />
                                                    <label class="form-label" for="firstName">First Name</label>
                                                </div>
                                                <div class="wr-msg" id="firstName1"></div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="text" id="userName" name="uname" class="form-control form-control-lg" value="<?php echo $row2['user_name'] ?>" />
                                                    <label class="form-label" for="userName">User Name</label>
                                                </div>
                                                <div class="wr-msg" id="userName1"></div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="date" id="DOB" name="dob" class="form-control form-control-lg" value="<?= $row['dob'] ?>" />
                                                    <label class="form-label" for="DOB">DOB</label>
                                                </div>
                                                <div class="wr-msg" id="DOB1"></div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="text" id="Location" name="loc" class="form-control form-control-lg" value="<?php echo $row['location'] ?>" />
                                                    <label class="form-label" for="Location">Location</label>
                                                </div>
                                                <div class="wr-msg" id="Location1"></div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="email" id="emailAddress" name="mail" class="form-control form-control-lg" value="<?php echo $row['email'] ?>" />
                                                    <label class="form-label" for="emailAddress">Email</label>
                                                </div>
                                                <div class="wr-msg" id="emailAddress1"></div>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="tel" id="phoneNumber" name="mob" class="form-control form-control-lg" value="<?php echo $row['mobile'] ?>" />
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                </div>
                                                <div class="wr-msg" id="phoneNumber1"></div>
                                            </div>
                                        </div>
                                        <h6></h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="row pt-1">
                                            <div class="col-6 mb-3">
                                                <button type="submit" id="btn" class="btn btn-outline-primary" name="sub" data-mdb-ripple-color="dark">Save Changes</button>
                                            </div>
                                            <!-- <div class="col-6 mb-3">
                            <button type="button" class="btn btn-outline-danger" data-mdb-ripple-color="dark">Delete Account</button>
                        </div> -->
                                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    
    <?php
    if (isset($_POST["sub"])) {
        $name1 = $_POST["fname"];
        $user = $_POST["uname"];
        $dob = $_POST["dob"];
        $loc = $_POST["loc"];
        $mail = $_POST["mail"];
        $mob = $_POST["mob"];
        $photo = $_FILES['myimage']['name'];
        if ($photo == "") {
            $query1 = "UPDATE `tbl_user` SET `first_name`='$name1',`dob`='$dob',`location`='$loc',`email`='$mail',`mobile`='$mob' WHERE  `login_id`='$tmp_id'";
        } else
            $query1 = "UPDATE `tbl_user` SET `first_name`='$name1',`dob`='$dob',`location`='$loc',`email`='$mail',`mobile`='$mob',`image`='$photo' WHERE  `login_id`='$tmp_id'";

        $con = mysqli_connect("localhost", "root", "", "mini-prj");

        $query2 = "UPDATE `tbl_login` SET `user_name`='$user' WHERE `login_id`=$tmp_id";
        $result1 = mysqli_query($con, $query1);
        $result = mysqli_query($con, $query2);
        $target = "Uploads/";
        $targetfilepath = $target . $photo;
        move_uploaded_file($_FILES['myimage']['tmp_name'], $targetfilepath);
        echo ("<script>location.href='userprofileedit.php'</script>");
    }
    ?>
    <!-- MDB -->
    <script> var usr_email = "<?php echo $row['email'] ?>"
    var usr_name="<?php echo $row2['user_name'] ?>"
    </script>
    <script src="profileupdatevalidation.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

</body>

</html>