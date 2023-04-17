<!DOCTYPE html>
<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
</head>

<body>
    <script>
        $(document).ready(function(){
            $('.toggle-btn').click(function(){
                var status=$(this).text()
                var id=$(this).data('id')
                if(status=='Active'){
                    $(this).removeClass('btn-success').addClass('btn-danger').text('Blocked')
                }else{
                    $(this).addClass('btn-success').removeClass('btn-danger').text('Active')

                }
                $.ajax({
                    url:'availability_status_ajax.php',
                    type: 'POST',
                    data:{
                        id:id,
                        status:status
                    },
                    success:function(data){
                        console.log(data);
                    }

                })
            })
        })
    </script>
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
    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <?php
            $query1 = "SELECT * FROM `tbl_vehicle` WHERE `user_id`=$tmp_id AND`status`=1;";
            $result1 = mysqli_query($con, $query1);
            ?>
            <section>
                <div class="container py-5">
                    <h4 class="text-center mb-5"><strong>Cars list</strong></h4>

                    <div class="row">
                        <?php
                        while ($row1 = mysqli_fetch_array($result1)) { ?>
                            <div class="col-lg-4 col-md-12 mb-4">
                                <div class="card">
                                    <div class="bg-image hover-zoom ripple shadow-1-strong rounded" style="height: 200px; overflow: hidden;">
                                        <img src="vehicle/<?= $row1["image1"] ?>" class="w-100 h-100 object-fit-cover" />
                                        <a href="owner_edit_cars.php?id=<?=$row1['vehicle_id']?>">
                                            <div class="mask" style="background-color: rgba(0, 0, 0, 0.3);">
                                                <div class="d-flex justify-content-start align-items-start h-100">
                                                    <h5><span class="badge bg-light pt-2 ms-3 mt-3 text-dark"><i class="fa fa-rupee"></i> <?= $row1["rate"] ?></span></h5>
                                                </div>
                                            </div>
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-row justify-content-center mt-3">
                                            <a href="" class="text-reset">
                                                <h5 class="card-title mb-3"><?= $row1["brand_name"] ?> <?= $row1["model_name"] ?></h5>
                                            </a>
                                        </div>
                                    <div class="card-body d-flex align-items-start justify-content-center">
                                        <?php
                                        if($row1['Availability']==1){
                                        ?>
                                        <button class="btn btn-success toggle-btn" data-id="<?=$row1['vehicle_id']?>" style="width:100px">Active</button>
                                        <?php }else{
                                            ?>
                                            <button class="btn btn-danger toggle-btn" data-id="<?=$row1['vehicle_id']?>" style="width:100px">Blocked</button>
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>