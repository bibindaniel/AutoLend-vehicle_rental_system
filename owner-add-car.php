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
    <link rel="stylesheet" href="confrimmodal.css">
</head>
<script>
    $(document).ready(function() {
        var check1 = 1;
        var check2 = 1;
        var check3 = 1;
        var check4 = 1;
        $("#brand").keyup(function() {
            var name = document.getElementById("brand").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                // show error message
                $("#brand1").text("*Not Valid");
                check1 = 1;
            } else {
                check1 = 0;
                // hide error message
                $('#btn').attr("disabled", false);
                $("#brand1").text("");
            }
        })
        $("#ModalName").keyup(function() {
            var name = document.getElementById("ModalName").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z0-9]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                // show error message
                $("#ModalName1").text("*Not Valid");
                check2 = 1;
            } else {
                check2 = 0;
                // hide error message
                $('#btn').attr("disabled", false);
                $("#ModalName1").text("");
            }
        })
        $("#Location").keyup(function() {
            var name = document.getElementById("Location").value
            var c_name = /^[a-zA-Z]+[ _a-zA-Z0-9]{2,20}$/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                // show error message
                $("#Location1").text("*Not Valid");
                check3 = 1;
            } else {
                check3 = 0;
                // hide error message
                $('#btn').attr("disabled", false);
                $("#Location1").text("");
            }
        })
        $("#year").keyup(function() {
            var name = document.getElementById("year").value
            var c_name = /(?:(?:19|20)[0-9]{2})/;
            var r_name = c_name.test(name)
            if (r_name == false) {
                // show error message
                $("#year1").text("*Not Valid");
                check4 = 1;
            } else {
                check4 = 0;
                // hide error message
                $('#btn').attr("disabled", false);
                $("#year1").text("");
            }
        })

        $("#btn").click(function(event) {
            var fuelType = $('#ftype').val();
            if (fuelType == null) {
                $('#ftype1').text('Please choose any option.').show();
            } else {
                $('#ftype1').text('')
            }
        });
        $("#btn").click(function(event) {
            var transmissionType = $('#trtype').val();
            if (transmissionType == null) {
                $('#trtype1').text('Please choose any option.').show();
            } else {
                $('#trtype1').text('')
            }
        });
        $("#btn").click(function(event) {
            var category = $('#cat').val();
            if (category == null) {
                $('#cat1').text('Please choose any option.').show();
            } else {
                $('#cat1').text('')
            }
        });
        $("#btn").click(function(event) {
            var seats = $('#seats').val();
            if (seats == null) {
                $('#seats1').text('Please choose any option.').show();
            } else {
                $('#seats1').text('')
            }
        });
        $('#ftype').change(function() {
            $('#ftype1').text('').hide();
            $('#btn').attr("disabled", false);
        });
        $('#trtype').change(function() {
            $('#trtype1').text('').hide();
            $('#btn').attr("disabled", false);
        });
        $('#cat').change(function() {
            $('#cat1').text('').hide();
            $('#btn').attr("disabled", false);
        });
        $('#seats').change(function() {
            $('#seats1').text('').hide();
            $('#btn').attr("disabled", false);
        });
        $("#btn").click(function(event) {
            if (check1 == 1 || check2 == 1 || check3 == 1 || check4 == 1) {
                $('#btn').attr("disabled", true);
            } else {
                $('#btn').attr("disabled", false);
            }
        })
    })

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
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function fileValidation1() {
        var fileInput =
            document.getElementById('rcbook');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#btn1').prop("disabled", true);
            alert('Invalid file type');
            fileInput.value = '';
            return false;
        } else {
            $('#btn').prop("disabled", false);
        }
    }

    function fileValidation2() {
        var fileInput =
            document.getElementById('puc');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#btn1').prop("disabled", true);
            alert('Invalid file type');
            fileInput.value = '';
            return false;
        } else {
            $('#btn').prop("disabled", false);
        }
    }

    function fileValidation3() {
        var fileInput =
            document.getElementById('insurance');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#btn1').prop("disabled", true);
            alert('Invalid file type');
            fileInput.value = '';
            return false;
        } else {
            $('#btn').prop("disabled", false);
        }
    }

    function fileValidation4() {
        var fileInput =
            document.getElementById('permit');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.pdf)$/i;

        if (!allowedExtensions.exec(filePath)) {
            $('#btn1').prop("disabled", true);
            alert('Invalid file type');
            fileInput.value = '';
            return false;
        } else {
            $('#btn').prop("disabled", false);
        }
    }

    function addTime() {
        // Check if more than 5 time fields have been added
        var timeInputs = document.getElementsByName('times[]');
        if (timeInputs.length === 5) {
            alert('You cannot add more than 5 available times.');
            return;
        }

        // Create a new input field with the 'time' type
        var newInput = document.createElement('input');
        newInput.type = 'time';
        newInput.name = 'times[]';
        newInput.classList.add('form-control', 'form-control-lg');
        newInput.required = true;

        // Add event listener to validate input times
        newInput.addEventListener('change', function() {
            var duplicate = false;
            for (var i = 0; i < timeInputs.length; i++) {
                if (timeInputs[i] !== this && timeInputs[i].value == this.value) {
                    duplicate = true;
                    break;
                }
            }
            if (duplicate) {
                alert('Duplicate time detected. Please enter a unique time.');
                this.value = '';
            }
        });

        // Disable the addTime button if there are already five input fields
        var timesWrapper = document.getElementById('times-wrapper');
        if (timesWrapper.childElementCount - 1 === 5) {
            document.getElementById('add-time-btn').disabled = true;
        }

        // Append the new input field to the form
        var wrapperDiv = document.createElement('div');
        wrapperDiv.classList.add('col-md-4', 'mb-4');
        wrapperDiv.appendChild(newInput);
        timesWrapper.appendChild(wrapperDiv);
    }

    function addLocation() {
        // Get the value from the input
        var locationInput = document.getElementById('location-input').value;

        // Check if the location has already been added to the list
        var locationsList = document.getElementById('location-list');
        var locationsArray = Array.from(locationsList.children).map((li) => li.textContent);
        if (locationsArray.includes(locationInput)) {
            alert('This location has already been added.');
            return;
        }

        // Add the location to the list
        var newLocation = document.createElement('li');
        newLocation.innerHTML = '<div class="form-outline"><input type="text" name="location[]" class="form-control form-control-lg" value="' + locationInput + '" required><label class="form-label">Location:</label></div>';
        locationsList.appendChild(newLocation);

        // Disable the input field if there are already five locations in the list
        if (locationsList.childElementCount === 5) {
            document.getElementById('location-input').disabled = true;
            document.getElementById('add-location-btn').disabled = true;
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
    $query1 = "SELECT * FROM `tbl_vehicle_category`";
    $res = mysqli_query($con, $query1);
    ?>
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="container py-2 h-100">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-12 col-lg-9 col-xl-12">
                            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                <div class="card-body p-4 p-md-5">
                                    <!-- <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3> -->
                                    <div class="row">
                                        <h6>Upload Images</h6>
                                        <span class="text-muted">click on below images to upload your vehicle</span>
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
                                                <input type="file" class="form-control file" id="image2" name="image2" accept="image/*" onchange="previewImage(event)" required>
                                                <img id="preview2" src="Images/carview2.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image3">Image 3</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image3" name="image3" accept="image/*" onchange="previewImage(event)" required>
                                                <img id="preview3" src="Images/carview3.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-4">
                                            <!-- <label class="" for="image4">Image 4</label> -->
                                            <div class="form-outline image-upload">
                                                <input type="file" class="form-control file" id="image4" name="image4" accept="image/*" onchange="previewImage(event)" required>
                                                <img id="preview4" src="Images/carview4.png" alt="Preview" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Vehicle Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="brand" name="bname" class="form-control form-control-lg" required>
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
                                                <input type="number" id="year" min="2000" max="2023" name="year" pattern="[0-9]{4}" class="form-control form-control-lg" placeholder="year" required />
                                                <label class="form-label" for="year">Year</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="year1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" id="ftype" name="ftype">
                                                <option value="-1" selected disabled>Fuel Type</option>
                                                <option value="petrol">Petrol</option>
                                                <option value="Diseal"> Diseal</option>
                                                <option value="Eletric"> Eletric</option>
                                                <option value="CNG">CNG</option>
                                            </select>
                                            <div class="wr-msg text-danger" id="ftype1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" id="trtype" name="trtype">
                                                <option value="-1" selected disabled>Transmission Type</option>
                                                <option value="Automatic">Automatic</option>
                                                <option value="Manual">Manual</option>
                                            </select>
                                            <div class="wr-msg text-danger" id="trtype1"></div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <select class="select form-control-lg" id="cat" name="cate">
                                                <option value="-1" selected disabled>Category</option>
                                                <?php
                                                while ($row = mysqli_fetch_array($res)) {
                                                ?>
                                                    <option value="<?= $row["category_id"] ?>"><?= $row["category_name"] ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="wr-msg text-danger" id="cat1"></div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <select class="select form-control-lg" id="seats" name="seats">
                                                <option value="-1" selected disabled>Seats</option>
                                                <option value="2seat">2 seater</option>
                                                <option value="5seat">5 seater</option>
                                                <option value="7seat">7 seater</option>
                                                <option value="9seat">9 seater</option>
                                            </select>
                                            <div class="wr-msg text-danger" id="seats1"></div>
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
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <textarea type="text" id="features" name="fea" class="form-control form-control-lg" maxlength="200" required></textarea>
                                                <label class="form-label" for="features">Features</label>
                                            </div>
                                            <div class="wr-msg text-danger" id="features1"></div>

                                        </div>
                                        <div id="times-wrapper" class="row">
                                            <div class="col-md-4 mb-4">
                                                <div class="form-outline">
                                                    <input type="time" id="time-input" name="times[]" class="form-control form-control-lg" value="12:00" required>
                                                    <label for="time-input" class="form-label">Available Times:</label>
                                                </div>
                                                <button onclick="addTime()" id="add-time-btn" class="btn">Add Time</button>

                                                <ul id="time-list">
                                                    <!-- This empty list will be populated with added times -->
                                                </ul>
                                                <div class="wr-msg text-danger" id="time-input1"></div>
                                            </div>
                                        </div>
                                        <div id="locations-wrapper" class="row">
                                            <div class="col-md-4 mb-4">
                                                <div class="form-outline">
                                                    <input type="text" id="location-input" name="location[]" class="form-control form-control-lg" required>
                                                    <label for="location-input" class="form-label">Location:</label>
                                                </div>
                                                <button onclick="addLocation()" id="add-location-btn" class="btn">Add Location</button>

                                                <ul id="location-list">
                                                    <!-- This empty list will be populated with added locations -->
                                                </ul>
                                                <div class="wr-msg text-danger" id="location-input1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-2">
                                    <h6>Upload Documents</h6><span class="text-muted">(scanned or digital copies '.pdf format')</span>
                                    <hr class="mt-0 mb-4">
                                    <div class="col-md-6 mb-4">
                                        <label class="" for="rcbook">RCBOOK</label>
                                        <div class="form-outline">
                                            <input type="file" class="form-control file" id="rcbook" name="rc" accept=".pdf" onchange="fileValidation1()" required>
                                        </div>
                                        <div class="filemsg text-danger" id="inputfileupload1"></div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="" for="puc">PUC Certificate</label>
                                        <div class="form-outline">
                                            <input type="file" class="form-control file" id="puc" name="puc" accept=".pdf" onchange="fileValidation2()" required>
                                        </div>
                                        <div class="filemsg text-danger" id="inputfileupload1"></div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="" for="insurance">Insurance</label>
                                        <div class="form-outline">
                                            <input type="file" class="form-control file" id="insurance" name="insurance" accept=".pdf" onchange="fileValidation3()" required>
                                        </div>
                                        <div class="filemsg text-danger" id="inputfileupload1"></div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label class="" for="permit">Permit</label>
                                        <div class="form-outline">
                                            <input type="file" class="form-control file" id="permit" name="permit" accept=".pdf" onchange="fileValidation4()" required>
                                        </div>
                                        <div class="filemsg text-danger" id="inputfileupload1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-danger" id="error-message"></div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary mb-3" id="btn" type="submit" name="sub" />
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
            </form>
        </div>
        </div>
    </main>
    <button type="button" id="modal-btn" style="display:none;" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#myModal">
        Launch demo modal
    </button>
    <button type="button" id="modal-btn1" style="display:none;" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#delModal">
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
                    <p class="text-center">Your request has been send . you will recieve a mail shortly</p>
                </div>
                <div class="modal-footer d-grid d-md-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal del -->
    <div id="delModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box" style="background-color:#fa0000;">
                        <i class="fa fa-times fa-3x"></i>
                    </div>
                    <h4 class="modal-title w-100">Oops!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Something went wrong.Please Try again</p>
                </div>
                <div class="modal-footer d-grid d-md-flex justify-content-center">
                    <button type="button" id="btn1" class="btn btn-secondary" data-mdb-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["sub"])) {
        $times = array();
        $bname = $_POST["bname"];
        $mname = $_POST["mname"];
        $mile = $_POST["mileage"];
        $yr = $_POST["year"];
        $ft = $_POST["ftype"];
        $trtype = $_POST["trtype"];
        $cat = $_POST["cate"];
        $seats = $_POST["seats"];
        $loc = $_POST["loc"];
        $rate = $_POST["rate"];
        $rc = $_FILES["rc"]["name"];
        $puc = $_FILES["puc"]["name"];
        $ins = $_FILES["insurance"]["name"];
        $per = $_FILES["permit"]["name"];
        $img1 = $_FILES["image1"]["name"];
        $img2 = $_FILES["image2"]["name"];
        $img3 = $_FILES["image3"]["name"];
        $img4 = $_FILES["image4"]["name"];
        $fea = $_POST["fea"];
        $time = $_POST["times"];
        if (empty($bname) || empty($mname) || empty($year) || empty($yr) || empty($ft) || empty($trtype) || empty($cat) || empty($seats) || empty($loc) || empty($rate) || empty($rc) || empty($puc) || empty($ins) || empty($per) || empty($img1) || empty($img2) || empty($img3) || empty($img4) || empty($fea)) {
            
            $query = "SELECT * FROM `tbl_vehicle` WHERE `brand_name` = '$bname' AND `model_name` = '$mname' AND `year` = '$yr' AND `location` = '$loc' AND `category_id` = '$cat' AND `user_id` = '$tmp_id'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                // Data already exists, display an error message
                // echo "Data already exists.";
            } else {
                $query1 = "INSERT INTO `tbl_vehicle`(`brand_name`, `model_name`, `mileage`, `year`, `fuel_type`, `transmission_type`, `seat`, `rate`,`location`, `category_id`, `user_id`, `rcbook`, `puc`, `insurance`, `permit`, `image1`, `image2`, `image3`, `image4`, `Features`) VALUES ('$bname','$mname',' $mile','$yr ',' $ft','$trtype','$seats','$rate','$loc','$cat','$tmp_id ','$rc','$puc','$ins','$per','$img1','$img2','$img3','$img4','$fea')";
                $res = mysqli_query($con, $query1);
                $id = mysqli_insert_id($con);
                $target = "vehicle/";
                $targetfilepath1 = $target . $img1;
                $targetfilepath2 = $target . $img2;
                $targetfilepath3 = $target . $img3;
                $targetfilepath4 = $target . $img4;
                $targetfilepath5 = $target . $rc;
                $targetfilepath6 = $target . $puc;
                $targetfilepath7 = $target . $ins;
                $targetfilepath8 = $target . $per;
                move_uploaded_file($_FILES['image1']['tmp_name'], $targetfilepath1);
                move_uploaded_file($_FILES['image2']['tmp_name'], $targetfilepath2);
                move_uploaded_file($_FILES['image3']['tmp_name'], $targetfilepath3);
                move_uploaded_file($_FILES['image4']['tmp_name'], $targetfilepath4);
                move_uploaded_file($_FILES['rc']['tmp_name'], $targetfilepath5);
                move_uploaded_file($_FILES['puc']['tmp_name'], $targetfilepath6);
                move_uploaded_file($_FILES['insurance']['tmp_name'], $targetfilepath7);
                move_uploaded_file($_FILES['permit']['tmp_name'], $targetfilepath8);
                $vid = mysqli_insert_id($con);
                foreach ($time as $ti) {
                    $query1 = "INSERT INTO `tbl_available_time`( `time`, `vehicle_id`) VALUES ('$ti','$vid')";
                    $result = mysqli_query($con, $query1);
                }

                if ($res) { ?>
                    <script>
                        $(document).ready(function() {
                            $("#modal-btn").click();
                        })
                    </script>
            <?php
                }
            }
        } else {
            ?>
            <script>
                $(document).ready(function() {
                    $("#modal-btn1").click();
                })
            </script>
    <?php
        }
    }

    ?>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>