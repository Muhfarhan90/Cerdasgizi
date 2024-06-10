<?php
include("../../logout.php");
include('../../database/database.php');


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Pasien</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php
        include('navbar-pasien.php');
        ?>

        <!-- fitur search -->
        <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
            <div class="navbar-links-wrapper d-flex align-items-stretch">
                <!-- Optional links here -->
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-search d-block d-md-none w-100"> <!-- Mobile View -->
                        <form action="" method="POST" class="w-100">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search" name="katakunci">
                                <div class="input-group-prepend">
                                    <button class="input-group-text" id="search" type="submit" name="cari">
                                        <i class="typcn typcn-zoom"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li class="nav-item nav-search d-none d-md-block mr-0"> <!-- Desktop View -->
                        <form action="" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search" name="katakunci">
                                <div class="input-group-prepend">
                                    <button class="input-group-text" id="search" type="submit" name="cari">
                                        <i class="typcn typcn-zoom"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close typcn typcn-times"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php
            include('sidebar-pasien.php');
            ?>
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h1 class="mb-2 text-titlecase mb-4">Daftar Ahligizi</h1>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_POST['cari'])) {
                            $katakunci = $_POST['katakunci'];
                            $query = "SELECT * FROM nutritionist WHERE fullname_nutritionist LIKE '%$katakunci%'";
                            $result = mysqli_query($conn, $query);
                        } else {
                            $query = "SELECT * FROM nutritionist";
                            $result = mysqli_query($conn, $query);
                        }
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-xl-4 grid-margin stretch-card flex-column">
                                    <div class="card border border-primary" style="width: 18rem;">


                                        <img src="../../images/icons8-doctor-32.png" class="card-img-top rounded-circle w-25" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['FULLNAME_NUTRITIONIST'] ?></h5>
                                            <p class="card-text">Berpengalaman <?= $row['YEARS_OF_EXPERIENCE'] ?> Tahun</p>
                                            <p class="card-text"><?= $row['EDUCATION'] ?></p>
                                            <a href="detail-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>" class="btn btn-primary">Lihat Ahligizi</a>
                                        </div>


                                    </div>
                                </div>

                        <?php

                            }
                        } else {
                            echo "Tidak ada data yang ditemukan";
                        }


                        ?>

                    </div>




                </div>
                <!-- main-panel ends -->
            </div>

            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- base:js -->
        <script src="../../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="../../vendors/chart.js/Chart.min.js"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../../js/off-canvas.js"></script>
        <script src="../../js/hoverable-collapse.js"></script>
        <script src="../../js/template.js"></script>
        <script src="../../js/settings.js"></script>
        <script src="../../js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="../../js/dashboard.js"></script>
</body>

</html>