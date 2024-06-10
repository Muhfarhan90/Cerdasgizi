<?php
include("../../logout.php");
include('../../database/database.php');

// ahligizi
$id = $_GET['id'];
$query = "SELECT * FROM nutritionist WHERE id_nutritionist = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// pasien
$nama_pasien = $_SESSION['username_user'];
$tanggal = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daftar Ahligizi</title>
    <!-- base:css -->
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css" />

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
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
                            <h1 class="mb-2 text-titlecase mb-4">Detail Ahligizi</h1>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 grid-margin stretch-card flex-column">

                            <div class="card" style="width: 18rem;">
                                <img src="../../images/icons8-doctor-32.png" class="card-img-top w-25" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['FULLNAME_NUTRITIONIST'] ?></h5>
                                    <p class="card-text">Spesialisasi Gizi</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Email : <?= $row['EMAIL_NUTRITIONIST'] ?></li>
                                    <li class="list-group-item">Lama Pengalaman : <?= $row['YEARS_OF_EXPERIENCE'] ?> Tahun</li>
                                    <li class="list-group-item">Pendidikan : <?= $row['EDUCATION'] ?></li>
                                    <li class="list-group-item">Setifikasi : <?= $row['CERTIFICATION'] ?></li>
                                </ul>
                                <div class="card-body d-flex ">
                                    <form action="konsultasi.php" method="GET" class="mr-4">
                                        <input type="hidden" name="nama_pasien" value="<?= htmlspecialchars($nama_pasien) ?>">
                                        <input type="hidden" name="id_ahligizi" value="<?= htmlspecialchars($id) ?>">
                                        <input type="hidden" name="nama_ahligizi" value="<?= htmlspecialchars($row['FULLNAME_NUTRITIONIST']) ?>">
                                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
                                        <button type="submit" class="btn btn-info" name="ajukan" onclick="return confirm('Apakah Anda yakin ingin mengajukan konsultasi?');">Ajukan Konsultasi</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- artikel yang dibuat -->
                    <?php
                    $query = "SELECT * FROM article WHERE id_nutritionist = $id";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {

                    ?>
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <h2>Top Artikel dari <?= $row['FULLNAME_NUTRITIONIST'] ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <?php

                            while ($row = mysqli_fetch_assoc($result)) {
                                $content = $row['CONTENT_ARTICLE'];
                                $excerpt = substr($content, 0, 100) . "...";
                            ?>
                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card" style="width: 18rem;">
                                        <img src="../../images/article/<?= $row['IMAGE_ARTICLE'] ?>" class="card-img-top pl-4 pt-4 w-25" alt="gambar-artikel" name="gambar">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $row['TITLE'] ?></h5>
                                            <p class="card-text"><?= $excerpt ?></p>
                                            <a href="detail-artikel.php?id=<?= $row['ID_ARTICLE'] ?>" class="btn btn-primary">Lihat Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    <?php
                    } else {
                        
                    }
                    ?>





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