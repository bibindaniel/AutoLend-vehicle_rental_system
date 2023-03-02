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
  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="adminpage.php" class="list-group-item list-group-item-action py-2 ripple " aria-current="true">
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
          </a>
          <a href="admin-users.php" class="list-group-item list-group-item-action py-2 ripple ">
            <i class="fas fa-users fa-fw me-3"></i><span>Users</span>
          </a>
          <a href="admin-owner.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user fa-fw me-3"></i><span>car owner</span></a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple active"><i class="fas fa-check-circle fa-fw me-3"></i><span>verify Users</span></a>
          <a href="admin-add-cat.php" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-solid fa-server fa-fw me-3"></i><span>Add category</span></a>
          <a href="admin-cars.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-solid fa-car fa-fw me-3"></i><span>vehicles</span></a>

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
        <small class="h3 text-light font-weight-bold text-align-center">ADMIN PANEL</small></a>
        <!-- Avatar -->
        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li><a class="dropdown-item" href="#">My profile</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Logout</a></li>
        </ul>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <?php
                $con = mysqli_connect("localhost", "root","", "mini-prj");
                $query = "SELECT tbl_user.first_name, tbl_user.email,tbl_user.image,tbl_user.user_id,tbl_verify_user.licence_no,tbl_verify_user.Expiry_date,tbl_verify_user.licence_file,tbl_verify_user.verify_status from tbl_user JOIN tbl_verify_user ON tbl_user.user_id=tbl_verify_user.user_id AND tbl_verify_user.verify_status = 0";
                $result = mysqli_query($con, $query);
                $count=mysqli_num_rows($result);
                if($count > 0){
      ?>
      <table class="table align-middle mb-0 bg-white" id="mytable">
        <thead class="bg-light">
          <tr>
            <th>Name</th>
            <th>License Details</th>
            <!-- <th>Status</th> -->
            <th>View License</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img src="uploads/<?= $row["image"] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                  <div class="ms-3">
                    <p class="fw-bold mb-1"><?= $row["first_name"] ?></p>
                    <p class="text-muted mb-0"><?= $row["email"] ?></p>
                  </div>
                </div>
              </td>
              <td>
                <p class="fw-normal mb-1"><?= $row["licence_no"] ?></p>
                <p class="text-muted mb-0"><?= $row["Expiry_date"] ?></p>
              </td>
              <td><button type="button" class="btn btn-info " onclick="location.href='Licence/<?php echo $row['licence_file']; ?>'" target="_blank">View</button></td>
              <td>
              <a href="#" id="verify_appr"   data-user-id="<?php echo $row['user_id']; ?>"> <i class="fa fa-check text-success"></i></a>
              <a href="#" id="verify_decli" class="ms-2"  data-user-id="<?php echo $row['user_id']; ?>"  > <i class="fa fa-times text-danger"></i></a>
              </td>
            <?php } ?>
            </tr>
        </tbody>
      </table>
      <?php }else {?>
        <div class="de-flex align-items-center">
        <p class="h2  text-center">No Request Pending</p>
        </div>
        <?php }?>
    </div>
  </main>
  <!-- data table -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
  <!--Main layout-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>
<script>
   $(document).ready(function() {
    var table = $('#mytable').DataTable({
                "lengthChange": false,
                pageLength: 6,
                lengthMenu: [
                    [5, 10, 20, -1],
                    [5, 10, 20, 'Todos']
                ]
            })
                // update verify_status
                $('#verify_appr').click(function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');

                    // send ajax request to update verify status in database
                    $.ajax({
                        url: 'accept_verify_status.php',
                        type: 'POST',
                        data: {
                            user_id: userId
                        },
                        success: function(response) {
                            console.log(response);
                            location.reload(true);
                        }
                    });
                });
                $('#verify_decli').click(function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');
                    // send ajax request to update verify status in database
                    $.ajax({
                        url: 'decline_verify_status.php',
                        type: 'POST',
                        data: {
                            user_id: userId
                        },
                        success: function(response) {
                            console.log(response);
                            location.reload(true);
                        }
                    });
                });
            });
</script>

</html>