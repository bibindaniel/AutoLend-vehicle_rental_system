<?php
session_start();
if ($_SESSION['logout'] == "") {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

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

<body>
    <style>
        .gradient-custom {
            background: rgb(2, 0, 36);
            background: linear-gradient(280deg, rgba(2, 0, 36, 1) 0%, rgba(14, 72, 73, 1) 37%, rgba(0, 212, 255, 1) 100%);
        }
    </style>
    <script>
        $(document).ready(function() {
            $(document).on('click', "#btn", function() {
                $('#exampleModal').modal('toggle')
            })
            var table = $('#mytable').DataTable({
                "lengthChange": false,
                pageLength: 6,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
            $(document).ready(function() {
                // toggle user status
                $(document).on('click', '.toggle-status', function(e) {
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
                        url: 'update_status.php',
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
            $(document).on('click', '.view-btn', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                $.ajax({
                    url: 'retrieve_data_owner.php',
                    type: 'POST',
                    data: {
                        id: userId
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log("data: ", data)
                        var name = '<p>' + data.value1 + '</p>';
                        var email = '<p>' + data.value2 + '</p>';
                        var mob = '<p>' + data.value3 + '</p>';
                        var dob = '<p>' + data.value4 + '</p>';
                        var image = data.value5;
                        var loc = '<p>' + data.value8 + '</p>';
                        $('#modal-name').html(name);
                        $('#modal-email').html(email);
                        $('#modal-mob').html(mob);
                        $('#modal-dob').html(dob);
                        $('#modal-loc').html(loc);
                        $('#modal-image').attr('src', 'Uploads/' + image);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Catch", textStatus, errorThrown);
                    }
                });
            });

        });
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
            <h4>OWNERS INFORMATION</h4>
            <div class="d-flex align-items-end justify-content-end">
                <a href="report_owners.php" class="btn btn-danger mb-2"><i class="fa fa-download"></i> Download REPORT</a>
            </div>
            <hr class="mt-0 mb-4">
            <table class="table align-middle mb-0 bg-white table-hover" id="mytable">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <!-- <th>Verification</th> -->
                        <th>Status</th>
                        <th>View</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `tbl_user` where user_type =2";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="Uploads/<?php echo $row['image'] ?>" class="rounded-circle" alt="" style="width: 45px; height: 45px" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo $row['first_name'] ?></p>
                                        <p class="text-muted mb-0"><?php echo $row['email'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <!-- <td>
                                <span class="badge badge-success rounded-pill d-inline">verified</span>
                            </td> -->
                            <td>
                                <?php if ($row['user_status'] == 1) { ?>
                                    <span class="user-status badge badge-success rounded-pill d-inline" data-user-id="<?php echo $row['user_id']; ?>">Active</span>
                                <?php } elseif ($row['user_status'] == 0) { ?>
                                    <span class="user-status badge badge-danger rounded-pill d-inline" data-user-id="<?php echo $row['user_id']; ?>">Blocked</span>
                                <?php } ?>
                            </td>
                            <td> <button type="button" class="btn btn-info view-btn" data-mdb-toggle="modal" data-mdb-target="#exampleModal" data-user-id="<?php echo $row['user_id']; ?>">
                                    View
                                </button></td>
                            <td>
                                <a href="#" class="toggle-status" title="Toggle Status" data-user-id="<?php echo $row['user_id']; ?>" data-toggle="tooltip">
                                    <?php if ($row['user_status'] == 1) { ?>
                                        <i class="fa fa-check text-success"></i>
                                    <?php } elseif ($row['user_status'] == 0) { ?>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-md-4 gradient-custom text-center text-white d-flex" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                            <div class="my-auto mx-auto">
                                <img src="images/users/aatik-tasneem-7omHUGhhmZ0-unsplash.jpg" id="modal-image" alt="Avatar" class="img-fluid my-4 rounded-circle " style="width: 80px;" />
                                <h5 id="modal-name"></h5>
                            </div>
                            <p id="modal-uname"></p>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-4">
                                <h6>Information</h6>
                                <hr class="mt-0 mb-4">
                                <div class="row pt-1">
                                    <div class="col-6 mb-3">
                                        <h6>Email</h6>
                                        <p class="text-muted" id="modal-email">info@example.com</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Phone</h6>
                                        <p class="text-muted" id="modal-mob">123 456 789</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>DOB</h6>
                                        <p class="text-muted" id="modal-dob">info@example.com</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h6>Location</h6>
                                        <p class="text-muted" id="modal-loc">123 456 789</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- data table -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>