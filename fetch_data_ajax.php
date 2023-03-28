<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");
if (isset($_POST["action"]) && $_POST["action"] == "fetch_data_ajax") {
    $minimum_price = $_POST["minimum_price"];
    $maximum_price = $_POST["maximum_price"];
    $status = $_POST['status'];
    $brand_filter = '';
    if(isset($_POST["brand"]) && is_array($_POST["brand"])) {
        $brand_filter = implode("','", $_POST["brand"]);
    }
    if(isset($_POST["cat"]) && is_array($_POST["cat"])) {
        $cat_filter = implode("','", $_POST["cat"]);
    }
    // Build SQL query based on filters
    $query = " SELECT * FROM tbl_vehicle WHERE status = 1 AND booking_status = 'available' 
 ";
    if (!empty($brand_filter)) {
        
        $query .= " AND brand_name IN ('$brand_filter')";
    }
    if (!empty($cat_filter)) {
        
        $query .= " AND category_id IN ('$cat_filter')";
    }

    // $query .= " AND price BETWEEN '" . $minimum_price . "' AND '" . $maximum_price . "'";

    // Execute SQL query
    $result = mysqli_query($conn, $query);
    $total_row = mysqli_num_rows($result);

    if ($total_row > 0) {
        while ($row = mysqli_fetch_array($result)) {
?>
            <div class="col mb-4">
                <div class="card h-100">
                    <!--Card image-->
                    <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                        <img src="vehicle/<?= $row["image1"] ?>" class="w-100 h-100 object-fit-cover" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                <div class="d-flex justify-content-start align-items-start h-100">
                                    <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><?= $row["rate"] ?></span></h5>
                                </div>
                            </div>
                            <div class="hover-overlay">
                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                            </div>
                        </a>
                    </div>

                    <!--Card content-->
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center mt-1">
                            <a href="" class="text-reset">
                                <h5 class="card-title mb-3"><?= $row["brand_name"] ?> <?= $row["model_name"] ?></h5>
                            </a>
                        </div>
                        <div class="text-center mb-2"><i class='fas fa-map-marker-alt'></i><span class="p-2"><?= $row["location"] ?></span></div>
                        <div class="d-flex flex-row justify-content-center mt-1 mb-4 text-danger">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <?php $id = $row["vehicle_id"] ?>
                        <div class="d-flex flex-row justify-content-center mt-1">
                            <?php
                            if ($status == 1) {
                            ?>
                                <button type="button" onclick="location.href='vehicle_det_usr.php?id= <?= $id ?>'" class="btn btn-primary gradient-custom ">BOOK NOW</button>
                            <?php
                            } else {
                            ?>
                                <button type="button" id="booknver" class="btn btn-primary gradient-custom ">BOOK NOW</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Close the card element -->
            </div>
<?php
        }
    } else {
        $output = '<h3>No Data Found</h3>';
    }
}
?>