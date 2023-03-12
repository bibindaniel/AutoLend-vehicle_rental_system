<?php
session_start();
$tmp_id = $_SESSION['id'];
if (isset($_POST["sub"])) {
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

    if (empty($bname) || empty($mname) || empty($year) || empty($yr) || empty($ft) || empty($trtype) || empty($cat) || empty($seats) || empty($loc) || empty($rate) || empty($rc) || empty($puc) || empty($ins) || empty($per) || empty($img1) || empty($img2) || empty($img3) || empty($img4)) {

        $con = mysqli_connect("localhost", "root", "", "mini-prj");
        $query = "SELECT * FROM `tbl_vehicle` WHERE `brand_name` = '$bname' AND `model_name` = '$mname' AND `year` = '$yr' AND `location` = '$loc' AND `category_id` = '$cat' AND `user_id` = '$tmp_id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
            // Data already exists, display an error message
            echo "Data already exists.";
        } else {
            // Data does not exist, insert into the database
            $query1 = "INSERT INTO `tbl_vehicle`(`brand_name`, `model_name`, `mileage`, `year`, `fuel_type`, `transmission_type`, `seat`, `rate`,`location`, `category_id`, `user_id`, `rcbook`, `puc`, `insurance`, `permit`, `image1`, `image2`, `image3`, `image4`) VALUES ('$bname','$mname',' $mile','$yr ',' $ft','$trtype','$seats','$rate','$loc','$cat','$tmp_id ','$rc','$puc','$ins','$per','$img1','$img2','$img3','$img4')";
            $res = mysqli_query($con, $query1);
            $id=mysqli_insert_id($con);
            $target = "vehicle/";
            $targetfilepath1 = $target . $img1;
            $targetfilepath2 = $target . $img2;
            $targetfilepath3 = $target . $img3;
            $targetfilepath4 = $target . $img4;
            move_uploaded_file($_FILES['image1']['tmp_name'], $targetfilepath1);
            move_uploaded_file($_FILES['image2']['tmp_name'], $targetfilepath2);
            move_uploaded_file($_FILES['image3']['tmp_name'], $targetfilepath3);
            move_uploaded_file($_FILES['image4']['tmp_name'], $targetfilepath4);

            if ($res) { ?>
                <script>
                  alert("success");
                </script>
<?php
            }
        }
    }else{
        
    }
}

?>