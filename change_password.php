<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$id=$_SESSION["id"];
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
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<style>
        body {
            font-family: 'Varela Round', sans-serif;
        }

        .modal-confirm {
            color: #636363;
            width: 325px;
            font-size: 14px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -15px;
        }

        .modal-confirm .form-control,
        .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
        }

        .modal-confirm .icon-box {
            color: #fff;
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: -70px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            z-index: 9;
            background: #82ce34;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .modal-confirm .icon-box i {
            font-size: 58px;
            position: relative;
            top: 3px;
        }
        .danger{
            background: #dc4c64;
        }
        .modal-confirm.modal-dialog {
            margin-top: 80px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #82ce34;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border: none;
        }

        .modal-confirm .btn:hover,
        .modal-confirm .btn:focus {
            background: #6fb32b;
            outline: none;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
<body>
    <script>
        $(document).ready(function() {
            $("#modal-btn").hide();
            $("#wr_icon").hide()
            $check=0;
            $check1=0;
            $("#Password").keyup(function() {
                var pswd = document.getElementById("Password").value
                var c_pass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                var r_pass = c_pass.test(pswd);
                if (r_pass == false) {
                    check=1;
                    $("#Password1").text("*Enter strong Password");
                    $("#wr_icon").show()
                } else {
                    check=0;
                    $("#Password1").text("");
                    $("#wr_icon").hide()
                    $('.btn').attr("disabled", false);
                }
            })
            $("#Cpassword").keyup(function() {
                pswd = document.getElementById("Password").value
                cpswd = document.getElementById("Cpassword").value
                if (cpswd != pswd) {
                    $("#Cpassword1").text("Passwords don't match");
                    check1 = 1;
                } else {
                    check1 = 0;
                    $("#Cpassword1").text("");
                    $('.btn').attr("disabled", false);
                }
            })
            $(".btn").click(function(){
                if(check==1 || check1==1){
                    $('.btn').attr("disabled", true);
                }else{
                    $('.btn').attr("disabled", false);
                }
            })
        });
    </script>
    <section class="vh-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-6">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="Images/Logo.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1 small">YOUR RENTAL SOLUTIONS</h4>
                                    </div>

                                    <form action="#" method="POST" enctype="multipart/form-data">

                                        <div class="col-md-12 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="password" id="Password" name="pass" class="form-control form-control-lg" required/>
                                                <label class="form-label" for="Password">New Password</label>
                                            </div>
                                            <i id="wr_icon" class="fa fa-exclamation-triangle text-danger" data-mdb-container="body" data-mdb-toggle="popover" data-mdb-trigger="hover" data-mdb-placement="bottom" data-mdb-content="Password Must contain 8 digits with atleast one upper,one lower,numbers and special characters"></i>
                                            <div class="wr-msg text-danger" id="Password1"></div>

                                        </div>
                                        <div class="col-md-12 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="password" id="Cpassword" name="cpass" class="form-control form-control-lg" required/>
                                                <label class="form-label" for="Cpassword">Retype Password</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="Cpassword1"></div>

                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="sub">submit
                                            </button>
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
       <!-- Button trigger modal -->
       <button type="button" id="modal-btn" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#myModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                    <i class="fa fa-check-circle fa-3x"></i>
                    </div>
                    <h4 class="modal-title w-100">Success!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your Password has been successfully updaed.</p>
                </div>
                <div class="modal-footer d-grid d-md-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
  <?php
  if(isset($_POST["sub"])){
    $pass=$_POST["pass"];
    include 'dbconnect.php';
    $query1 ="UPDATE `tbl_login` SET `password`='$pass' WHERE `login_id`=$id";
    $res=mysqli_query($con, $query1);
    if($res){
        session_destroy();
        echo ("<script>location.href='login.php'</script>");
    }
  }
  ?>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
</body>

</html>