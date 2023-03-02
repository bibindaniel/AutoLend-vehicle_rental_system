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
</head>

<body>
    <style>
        .counter {
            color: #eb3b5a;
            font-family: 'Muli', sans-serif;
            width: 200px;
            height: 200px;
            text-align: center;
            border-radius: 100%;
            padding: 77px 32px 40px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .counter:before,
        .counter:after {
            content: "";
            background: #fff;
            width: 80%;
            height: 80%;
            border-radius: 100%;
            box-shadow: -5px 5px 5px rgba(0, 0, 0, 0.3);
            transform: translateX(-50%)translateY(-50%);
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: -1;
        }

        .counter:after {
            background: linear-gradient(45deg, #B81242 49%, #D74A75 50%);
            width: 100%;
            height: 100%;
            box-shadow: none;
            transform: translate(0);
            top: 0;
            left: 0;
            z-index: -2;
            clip-path: polygon(50% 50%, 50% 0, 100% 0, 100% 100%, 0 100%, 0 50%);
        }

        .counter .counter-icon {
            color: #fff;
            background: linear-gradient(45deg, #B81242 49%, #D74A75 50%);
            font-size: 33px;
            line-height: 70px;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            transition: all 0.3s;
        }

        .counter .counter-icon i.fa {
            transform: rotateX(0deg);
            transition: all 0.3s ease 0s;
        }

        .counter:hover .counter-icon i.fa {
            transform: rotateX(360deg);
        }

        .counter h3 {
            font-size: 17px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 3px;
        }

        .counter .counter-value {
            font-size: 30px;
            font-weight: 700;
        }

        .counter.orange {
            color: #F38631;
        }

        .counter.orange:after,
        .counter.orange .counter-icon {
            background: linear-gradient(45deg, #F38631 49%, #F8A059 50%);
        }

        .counter.green {
            color: #88BA1B;
        }

        .counter.green:after,
        .counter.green .counter-icon {
            background: linear-gradient(45deg, #88BA1B 49%, #ACD352 50%);
        }

        .counter.blue {
            color: #5DB3E4;
        }

        .counter.blue:after,
        .counter.blue .counter-icon {
            background: linear-gradient(45deg, #5DB3E4 49%, #7EBEE1 50%);
        }

        @media screen and (max-width:990px) {
            .counter {
                margin-bottom: 40px;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.counter-value').each(function() {
                $(this).prop('Counter', 0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 3500,
                    easing: 'swing',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        });
    </script>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                    </a>
                    <a href="admin-users.php" class="list-group-item list-group-item-action py-2 ripple ">
                        <i class="fas fa-users fa-fw me-3"></i><span>Users</span>
                    </a>
                    <a href="admin-owner.php" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-user fa-fw me-3"></i><span>car owner</span></a>
                    <a href="admin-verify.php" class="list-group-item list-group-item-action py-2 ripple "><i class="fas fa-check-circle fa-fw me-3"></i><span>verify Users</span></a>
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

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6 my-4">
                        <div class="counter blue">
                            <div class="counter-icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <h3>Renters</h3>
                            <span class="counter-value">17</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-auto">
                        <div class="counter green">
                            <div class="counter-icon">
                                <i class="fa fa-user"></i>
                            </div>
                            <h3>Car Owners</h3>
                            <span class="counter-value">16</span>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </main>
    <!--Main layout-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
<script src="adminpanel.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


</html>