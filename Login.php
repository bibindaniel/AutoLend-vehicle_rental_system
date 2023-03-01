<!DOCTYPE html>
<html lang="en">
<?php
session_start();
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
    <link rel="stylesheet" href="loginstyle.css">
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="Images/Logo.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1 small">YOUR RENTAL SOLUTIONS</h4>
                                    </div>

                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example11" class="form-control" placeholder="User Name" name="user" />
                                            <label class="form-label" for="form2Example11">Username</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" name="pass" />
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="sub">Log
                                                in</button>
                                            <a class="text-muted" href="forgot_password.php">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <button type="button" class="btn btn-outline-danger" onclick="location.href='registration.php'">Create new</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a company</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
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
        $uname = $_POST["user"];
        $pass = $_POST["pass"];
        if ($uname != null && $pass != null) {
            $con = mysqli_connect("localhost", "root", "", "mini-prj");
            $query1 = "SELECT * FROM `tbl_login` ";
            $result = mysqli_query($con, $query1);
            while ($row = mysqli_fetch_array($result)) {
                if ($uname == $row['user_name'] && $pass == $row['password']) {
                    $flag = 1;
                    $id = $row['login_id'];
                    $query2 = "SELECT * FROM `tbl_user` WHERE `login_id`=$id";
                    $result1 = mysqli_query($con, $query2);
                    $row1 = mysqli_fetch_array($result1);
                    if ($row1["user_status"] == 1) {
                        $_SESSION['id'] = $row['login_id'];
                        $_SESSION['logout'] = "yes";
                        if ($row1["user_type"] == 1) {
                            echo ("<script>location.href='lpage.php'</script>");
                        } elseif ($row1["user_type"] == 3) {
                            echo ("<script>location.href='adminpage.php'</script>");
                        }
                    }else{
                        echo ("<script>alert('your account is blocked ')</script>");
                    }
                }
            }
            if ($flag != 1) {
                echo ("<script>alert('Invalid username or password ')</script>");
            }
        }
    }
    ?>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
</body>

</html>