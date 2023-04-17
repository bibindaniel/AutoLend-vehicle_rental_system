<!DOCTYPE html>
<html lang="en">
<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';
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

<body>
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
    <script>
        $(document).ready(function() {
            $("#modal-btn").hide();
            $("#emailAddress").keyup(function() {
                var email = document.getElementById("emailAddress").value
                $.ajax({
                    url: 'emailvalidate.php',
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        if (data != '0') {
                            $('.btn').attr("disabled", false);
                            $("#emailAddress1").text("");
                        } else {
                            $('.btn').attr("disabled", true);
                            $('#emailAddress1').html('<span class="text-danger">Email not registred</span>');
                        }
                    }
                })
            });
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

                                        <div class="form-outline mb-4">
                                            <input type="text" id="emailAddress" class="form-control" placeholder="your email" name="email" focus />
                                            <label class="form-label" for="emailAddress">Email</label>
                                        </div>
                                        <div class="wr-msg" id="emailAddress1"></div>

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
                    <p class="text-center">Your reset mail has been sent. Check your email for detials.</p>
                </div>
                <div class="modal-footer d-grid d-md-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["sub"])) {
        $email = $_POST["email"];
        include 'dbconnect.php';
        $query1 ="SELECT * FROM `tbl_user` WHERE `email`= '$email'";
        $result=mysqli_query($con, $query1);
        $row=mysqli_fetch_array($result);
        $name=$row['first_name'];
        $_SESSION["id"]=$row["login_id"];
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'bibinpdaniel2025@mca.ajce.in';                     //SMTP username
            $mail->Password   = 'kichuDI@12';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('bibinpdaniel2025@mca.ajce.in', 'Mailer');
            $mail->addAddress("$email", "$name");     //Add a recipient
            //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Reset Password';
            $mail->Body    = "
            Hi  $name,
            
            There was a request to change your password!
            
            If you did not make this request then please ignore this email.
            
            Otherwise, please click this link to change your password: http://localhost/Autolend/change_password.php#';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients";

            $mail->send();
            ?>
            <script>
                console.log("message sent");
                $(document).ready(function(){
                    $("#modal-btn").click();
                })
                </script>
            <?php
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    ?>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
</body>

</html>