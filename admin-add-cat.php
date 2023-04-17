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
    <!-- data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
</head>
<style>
    .gradient-custom {
        background: rgb(2, 0, 36);
        background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
    }
</style>

<body>
    <script>
        $(document).ready(function() {
            var table = $('#mytable').DataTable({
                "lengthChange": false,
                pageLength: 4,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
            $("#name").keyup(function() {
                var name = document.getElementById("name").value
                var c_name = /^[a-zA-Z]+[_a-zA-Z0-9]{2,20}$/;
                var r_name = c_name.test(name)
                if (r_name == false) {
                    $("#name1").text("*Not Valid");
                    $('#btn-modal').attr("disabled", true);
                    check1 = 1;
                } else {
                    $.ajax({
                        url: 'category_validate.php',
                        method: "POST",
                        data: {
                            name: name
                        },
                        success: function(data) {
                            if (data != '0') {
                                $('#name1').html('<span class="text-danger">category name Already exist</span>');
                            } else {
                                check1 = 0;
                                $('#btn-modal').attr("disabled", false);
                                $("#name1").text("");
                            }
                        }
                    })

                }
            })
            $("#btn-modal").click(function() {
                var name = document.getElementById("name").value
                var img = document.getElementById('img').value;
                if (name.length == 0 || img.length == 0) {
                    $('#btn-modal').attr("disabled", true);
                } else {
                    $('#btn-modal').attr("disabled", false);
                }
            });
            $(document).on('click','.toggle-status',function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                var statusElm = $('.user-status[data-user-id="' + userId + '"]');
                var status = statusElm.text();

                // update user status and icon
                if (status == 'Active') {
                    statusElm.text('Blocked').removeClass('badge-success').addClass('badge-danger');
                    $(this).html('<i class="fa fa-times text-danger"></i>');
                } else if (status == 'Blocked') {
                    statusElm.text('Active').removeClass('badge-danger').addClass('badge-success');
                    $(this).html('<i class="fa fa-check text-success"></i>');
                }

                // send ajax request to update user status in database
                $.ajax({
                    url: 'update_cate.php',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        status: statusElm.text()
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });

        function fileValidation() {
            var fileInput =
                document.getElementById('img');
            var filePath = fileInput.value;
            // Allowing file type
            var allowedExtensions =
                /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if (!allowedExtensions.exec(filePath)) {
                $('#btn-modal').attr("disabled", true);
                alert('Please upload image files');
                fileInput.value = '';
                return false;
            } else {
                $('#btn-modal').attr("disabled", false);
            }
        }
    </script>
    <!--Main Navigation-->
    <?php
    $tmp_id = $_SESSION['id'];
    include 'dbconnect.php';
    $query = "SELECT `image` FROM `tbl_user` WHERE `login_id`='$tmp_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['image'];
    ?>
     <?php
    include("adminsidebar.php");
    ?>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-info" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                    <i class="fas fa-plus mx-1"></i>Add Items
                </button>
            </div>
            <table class="table align-middle mb-0 bg-white table-hover" id="mytable">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM  `tbl_vehicle_category`";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo $row['category_name'] ?></p>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <?php if ($row['status'] == 1) { ?>
                                    <span class="user-status badge badge-success rounded-pill d-inline" data-user-id="<?php echo $row['category_id']; ?>">Active</span>
                                <?php } elseif ($row['status'] == 0) { ?>
                                    <span class="user-status badge badge-danger rounded-pill d-inline" data-user-id="<?php echo $row['category_id']; ?>">Blocked</span>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="#" class="toggle-status" title="Toggle Status" data-user-id="<?php echo $row['category_id']; ?>" data-toggle="tooltip">
                                    <?php if ($row['status'] == 1) { ?>
                                        <i class="fa fa-check text-success"></i>
                                    <?php } elseif ($row['status'] == 0) { ?>
                                        <i class="fa fa-times text-danger"></i>
                                    <?php } ?>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="form">
                        <div class="row pt-1">
                            <div class="col-6 mb-3">
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <label class="form-label" for="name">Category Name</label>
                                    <div class="form-outline">
                                        <input type="text" id="name" name="name" class="form-control form-control-lg" value="" oninput="this.value = this.value.toUpperCase()" required />
                                    </div>
                                    <div class="wr-msg text-danger" id="name1"></div>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="img">Upload image</label>
                                <div class="form-outline">
                                    <input type="file" id="img" name="img" class="form-control form-control-lg" value="" accept="image/png, image/gif, image/jpeg" onchange="fileValidation()" required />
                                </div>
                                <div class="wr-msg text-danger" id="img1"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" id="btn-modal" class="btn btn-primary" name="sub">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["sub"])) {
        $name = $_POST["name"];
        $img = $_FILES["img"]["name"];
        include 'dbconnect.php';
        $query1 = "INSERT INTO `tbl_vehicle_category`(`category_name`, `image`) VALUES ('$name','$img')";
        $res = mysqli_query($con, $query1);
        if ($res) {
            $target = "Uploads/";
            $targetfilepath = $target . $img;
            move_uploaded_file($_FILES['img']['tmp_name'], $targetfilepath);
            echo ("<script>location.href='admin-add-cat.php'</script>");
        }
        mysqli_close($con);
    }
    ?>
    <!-- data table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>