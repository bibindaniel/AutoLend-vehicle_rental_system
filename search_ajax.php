<?php
$conn = mysqli_connect("localhost", "root", "", "mini-prj");

if (isset($_POST['term'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['term']);
    $status = $_POST['status'];
    $sql = "SELECT * FROM tbl_vehicle WHERE status = 1 AND booking_status = 'available' 
            AND (brand_name LIKE '%$searchTerm%' OR model_name LIKE '%$searchTerm%')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
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
        echo "<p>No results found.</p>";
    }
}
?>