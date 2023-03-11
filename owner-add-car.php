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
    <link rel="stylesheet" href="adminpanel.css">
</head>
<script>
    $(document).ready(function() {
        $(".success-msg").hide();
        $(".error-msg").hide();
        $(document).click(function() {
            $(".success-msg").hide();
        });
        var check1 = 1;
        var check2 = 1;
        var check3 = 1;
        var check4 = 1;
        $("#brand").keyup(function() {
            var name = document.getElementById("brand").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                $("#brand1").text("*Not Valid");
                check1 = 1;
            } else {
                check1 = 0;
                $('#btn').attr("disabled", false);
                $("#brand1").text("");
            }
        })
        $("#ModalName").keyup(function() {
            var name = document.getElementById("ModalName").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z0-9]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                $("#ModalName1").text("*Not Valid");
                check2 = 1;
            } else {
                check2 = 0;
                $('#btn').attr("disabled", false);
                $("#ModalName1").text("");
            }
        })
        $("#Location").keyup(function() {
            var name = document.getElementById("Location").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z0-9]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                $("#Location1").text("*Not Valid");
                check3 = 1;
            } else {
                check3 = 0;
                $('#btn').attr("disabled", false);
                $("#Location1").text("");
            }
        })
        $("#year").keyup(function() {
            var name = document.getElementById("year").value
            var c_name = /(?:(?:19|20)[0-9]{2})/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                $("#year1").text("*Not Valid");
                check4 = 1;
            } else {
                check4 = 0;
                $('#btn').attr("disabled", false);
                $("#year1").text("");
            }
        })
        $("#btn").click(function(e) {
            var bname = document.getElementById("brand").value;
            var mname = document.getElementById("ModalName").value;
            var year = document.getElementById("year").value;
            var loc = document.getElementById("Location").value;
            var rate = document.getElementById("rate").value;
            var img = document.getElementById("inputfileupload").value
            if (bname.length == 0 || mname.length == 0 || year.length == 0 || loc.length == 0 || rate.length == 0 || img.length == 0) {
                $('#btn').attr("disabled", true);
                alert("Please fill all fields Correctly");
                e.preventDefault();
            } else {
                $('#btn').attr("disabled", false);
            }
            if (check1 == 1 || check2 == 1 || check3 == 1 || check4 == 1) {
                $('#btn').attr("disabled", true);
            } else {
                $('#btn').attr("disabled", false);
            }
        })

        function fileValidation() {
            // get the selected file
            var fileInput = $(this);
            var fileName = fileInput.val();
            // check if the file is a pdf
            if (fileName.lastIndexOf(".pdf") === -1) {
                // show error message
                fileInput.parent().next(".filemsg").html("Only PDF files are allowed.").show();
                fileInput.val('');
                return false;
            } else {
                // hide error message
                fileInput.parent().next(".filemsg").html("").hide();
                return true;
            }
        }
        // call fileValidation function when file input changes
        $(".file").change(fileValidation);
    })

    function fileValidation(ffileInput) {
        var fileInput =
            document.getElementById('inputfileupload');
        var filePath = fileInput.value;
        // Allowing file type
        var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#btn').attr("disabled", true);
            alert('only image files allowed');
            fileInput.value = '';
            return false;
        } else {
            $('#btn').attr("disabled", false);
        }
    }

    function previewImage(event) {
        var input = event.target;
        var id = input.id;
        var img = document.getElementById('preview' + id.substr(id.length - 1));

        if (input.files && input.files[0]) {
            var fileType = input.files[0].type;
            if (!fileType.startsWith('image/')) {
                alert('Please upload an image file.');
                input.value = '';
                return;
            } else if (!/\.(jpe?g|png|gif)$/i.test(input.files[0].name)) {
                alert('Please upload a valid image file (JPEG, PNG or GIF).');
                input.value = '';
                return;
            }
            var reader = new FileReader();
            reader.onload = function(e) {
                img.setAttribute('src', e.target.result);
                fileValidation(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<style>
    select {
        width: 100%;
        max-width: 300px;
    }

    .image-upload {
        position: relative;
    }

    .image-upload input[type=file] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>

<body>
    <?php
    $tmp_id = $_SESSION['id'];
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    ?>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="owner-dashboard.php" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple active ">
                        <i class="fas fa-plus-square fa-fw me-3"></i><span>Add cars</span>
                    </a>
                    <a href="owner-view-cars.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas  fa-car fa-fw me-3"></i><span>View Cars</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-bell fa-fw me-3"></i><span>View Request</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-address-book fa-fw me-3"></i><span>View Bookings</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light  fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="images/Logo.png" height="45" alt="" loading="lazy" />
                    <small class="ms-2 text-light">AutoLend</small></a>
                </a>
                <small class="h3 text-light font-weight-bold text-align-center">DashBoard</small></a>

                <!-- Avatar -->
                <div class="dropdown ">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" height="25" alt="profile pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="l-car-owner-page.php">Home</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="sessiondestroy.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">My profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->
    <?php
    $con = mysqli_connect("localhost", "root", "", "mini-prj");
    $query1 = "SELECT * FROM `tbl_vehicle_category`";
    $res = mysqli_query($con, $query1);
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="container py-2 h-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-12 col-lg-9 col-xl-12">
                        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                            <div class="card-body p-4 p-md-5">
                                <!-- <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3> -->
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <h6>Upload Images</h6>
                                        <span class="text-muted">click on below images to upload your vehicle (altest one)</span>
                                        <hr class="mt-0 mb-4">
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image1">Image 1</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image1" name="image1" accept="image/*" onchange="previewImage(event)" required>
                                                <img id="preview1" src="Images/carview1.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image2">Image 2</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image2" name="image2" accept="image/*" onchange="previewImage(event)">
                                                <img id="preview2" src="Images/carview2.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image3">Image 3</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image3" name="image3" accept="image/*" onchange="previewImage(event)">
                                                <img id="preview3" src="Images/carview3.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image4">Image 4</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image4" name="image4" accept="image/*" onchange="previewImage(event)">
                                                <img id="preview4" src="Images/carview4.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Vehicle Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="brand" name="bname" class="form-control form-control-lg" required />
                                                <label class="form-label" for="brand">Brand Name</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="brand1"></div>


                                        </div>
                                        <div class="col-md-4 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="ModalName" name="mname" class="form-control form-control-lg" required />
                                                <label class="form-label" for="ModalName">Model Name</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="ModalName1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">

                                            <div class="form-outline">
                                                <input type="Number" id="Mileage" name="mileage" min="1" class="form-control form-control-lg" required />
                                                <label class="form-label" for="Mileage">Mileage</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="Mileage1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="form-outline">
                                                <input type="date" id="year" name="year" pattern="[0-9]{4}" required class="form-control form-control-lg" placeholder="YYYY-MM-DD" required />
                                                <label class="form-label" for="year">Year</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="year1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" id="type" name="cate">
                                                <option value="-1" selected disabled>Fuel Type</option>
                                                <option value="petrol">Petrol</option>
                                                <option value="Diseal"> Diseal</option>
                                                <option value="Eletric"> Eletric</option>
                                                <option value="CNG">CNG</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" name="cate">
                                                <option value="-1" selected disabled>Transmission Type</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" name="cate">
                                                <option value="-1" selected disabled>Category</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($res)) {
                                                ?>
                                                    <option value="<?= $row["category_id"] ?>"><?= $row["category_name"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <select class="select form-control-lg" name="cate">
                                                <option value="-1" selected disabled>Seats</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h6>Rental Information</h6>
                                        <hr class="mt-0 mb-4">
                                        <div class="col-md-4 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="number" id="rate" min="100" name="rate" class="form-control form-control-lg" required />
                                                <label class="form-label" for="rate">Rate</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="rate1"></div>

                                        </div>
                                        <div class="col-md-4 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="Location" name="loc" class="form-control form-control-lg" required />
                                                <label class="form-label" for="Location">Location</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="Location1"></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <h6>Upload Documents</h6><span class="text-muted">(scanned or digital copies '.pdf format')</span>
                                        <hr class="mt-0 mb-4">
                                        <div class="col-md-6 mb-4">
                                            <label class="" for="rcbook">RCBOOK</label>
                                            <div class="form-outline">
                                                <input type="file" class="form-control file" id="rcbook" name="rc" accept=".pdf" onchange="fileValidation()" required>
                                            </div>
                                            <div class="filemsg text-danger" id="inputfileupload1"></div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="" for="puc">PUC Certificate</label>
                                            <div class="form-outline">
                                                <input type="file" class="form-control file" id="puc" name="puc" accept=".pdf" onchange="fileValidation()" required>
                                            </div>
                                            <div class="filemsg text-danger" id="inputfileupload1"></div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="" for="insurance">Insurance</label>
                                            <div class="form-outline">
                                                <input type="file" class="form-control file" id="insurance" name="insurance" accept=".pdf" onchange="fileValidation()" required>
                                            </div>
                                            <div class="filemsg text-danger" id="inputfileupload1"></div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="" for="permit">Permit</label>
                                            <div class="form-outline">
                                                <input type="file" class="form-control file" id="permit" name="permit" accept=".pdf" onchange="fileValidation()" required>
                                            </div>
                                            <div class="filemsg text-danger" id="inputfileupload1"></div>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-block fa-lg gradient-custom mb-3" id="btn" type="submit" name="sub" value="Submit" />
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php include 'addcars.php' ?>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>