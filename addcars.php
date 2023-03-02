<?php
 if (isset($_POST["sub"])) {
    $bname = $_POST["bname"];
    $mname = $_POST["mname"];
    $yr = $_POST["year"];
    $loc = $_POST["loc"];
    $rate = $_POST["rate"];
    $cat = $_POST["cate"];
    $img = $_FILES["myimage"]["name"];

    if($bname !=null && $mname !=null && $yr !=null && $rate !=null && $cat !=null && $img){

        // Check if the data already exists
        $query = "SELECT * FROM `tbl_vehicle` WHERE `brand_name` = '$bname' AND `model_name` = '$mname' AND `year` = '$yr' AND `location` = '$loc' AND `category_id` = '$cat'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0) {
            // Data already exists, display an error message
            echo "Data already exists.";
        } else {
            // Data does not exist, insert into the database
            $query1 = "INSERT INTO `tbl_vehicle`(`brand_name`, `model_name`, `year`, `rate`,`location`, `category_id`, `user_id`,`image`) VALUES ('$bname','$mname','$yr',' $rate','$loc','$cat',' $tmp_id','$img')";
            $res = mysqli_query($con, $query1);
            $target = "vehicle/";
            $targetfilepath = $target . $img;
            move_uploaded_file($_FILES['myimage']['tmp_name'], $targetfilepath);
            if ($res) { ?>
                <script>
                    $(document).ready(function() {
                        $(".success-msg").show();
                    })
                </script>
            <?php
            }
        }
    }
}

    ?>