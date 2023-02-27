<!DOCTYPE html>
<html lang="en">
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
        <link rel="stylesheet" href="registrationstyle.css">
        <!-- jquery cdn -->
        <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
        <!-- ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <!-- script file -->
        <script src="registrationvalidation.js"></script>
</head>
<body class="gradient-custom">
    <section class="vh-100 my-5">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            <form action="#" method="POST" enctype="multipart/form-data">

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="firstName" name="fname" class="form-control form-control-lg" />
                    <label class="form-label" for="firstName">First Name</label>
                  </div>
                  <div class="wr-msg" id="firstName1"></div>
                  

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="lastName" name="lname" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">User Name</label>
                  </div>
                  <div class="wr-msg" id="lastName1"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="date" id="DOB" name="dob" class="form-control form-control-lg" />
                    <label class="form-label" for="DOB">DOB</label>
                  </div>
                  <div class="wr-msg" id="DOB1"></div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="Location" name="loc" class="form-control form-control-lg" />
                    <label class="form-label" for="Location">Location</label>
                  </div>
                  <div class="wr-msg" id="Location1"></div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="email" id="emailAddress" name="mail" class="form-control form-control-lg" />
                    <label class="form-label" for="emailAddress">Email</label>
                  </div>
                  <div class="wr-msg" id="emailAddress1"></div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="tel" id="phoneNumber" name="mob" class="form-control form-control-lg" />
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                  </div>
                  <div class="wr-msg" id="phoneNumber1"></div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="password" id="Password" name="pass" class="form-control form-control-lg" />
                    <label class="form-label" for="Password">Password</label>
                  </div>
                  <div class="wr-msg" id="Password1"></div>
                  

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="password" id="Cpassword" name="cpass" class="form-control form-control-lg" />
                    <label class="form-label" for="Cpassword">Confirm Password</label>
                  </div>
                  <div class="wr-msg" id="Cpassword1"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <label class="">Choose option</label>
                  <select class="select form-control-lg" name="user_type">
                    <option value="-1" disabled>Choose option</option>
                    <option value="1">Renter</option>
                    <option value="2">vehicle Owner</option>
                  </select>
                  

                </div>
                <div class="col-md-6 mb-4">
                  <label class="" for="Image">image</label>
                  <div class="form-outline">
                    <input type="file" class="form-control" id="inputfileupload" name="myimage" accept="image/png, image/gif, image/jpeg" onchange="fileValidation()">
                    
                  </div>
                  <div class="wr-msg" id="inputfileupload1"></div>

                </div>
              </div>

              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-block fa-lg gradient-custom mb-3" id="btn" type="submit" name="sub" value="Submit" />
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
if(isset($_POST["sub"])){
$name1=$_POST["fname"];
$user=$_POST["lname"];
$dob=$_POST["dob"];
$loc=$_POST["loc"];
$mail=$_POST["mail"];
$mob=$_POST["mob"];
$pass=$_POST["pass"];
$utype=$_POST["user_type"];
$photo = $_FILES['myimage']['name'];
$flag=0;
 if($name1 !=null && $user !=null && $dob !=null && $loc !=null && $mail !=null && $mob !=null && $pass!=NULL && $utype !==null && $photo !=null  ){
  $flag = 1;
  $con = mysqli_connect("localhost", "root","", "mini-prj");
  $query1 ="INSERT INTO `tbl_login`(`user_name`,`password`) VALUES ('$user','$pass')";
  mysqli_query($con, $query1);
  $login_id = mysqli_insert_id($con);
  $query2 ="INSERT INTO `tbl_user`(`login_id`, `first_name`, `dob`, `location`, `email`, `mobile`, `user_type`, `image`) VALUES ('$login_id','$name1','$dob','$loc','$mail','$mob','$utype','$photo')";
  mysqli_query($con, $query2);
  $user_id=mysqli_insert_id($con);
  $target = "Uploads/";
  $targetfilepath = $target . $photo;
  move_uploaded_file($_FILES['myimage']['tmp_name'], $targetfilepath);
  $url = "login.php";
  if($utype==1){
    $query3 ="INSERT INTO `tbl_verify_user`(`user_id`, `verify_status`) VALUES ('$user_id','-1')";
    mysqli_query($con, $query3);
  }
 }
 if ($flag == 1) {
  echo ("<script>location.href='$url'</script>");
}
}

?>
    <!-- MDB -->
    <script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
    ></script>
</body>
</html>