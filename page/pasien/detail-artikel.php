<?php
include("../../logout.php");
include('../../database/database.php');

$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM patient WHERE id_user = $id_user";
$hasil = mysqli_query($conn, $sql);
$baris = mysqli_fetch_assoc($hasil);

// ambil id pasien
$id_pasien = $baris['ID_PATIENT'];

$id = $_GET['id'];
$query = "SELECT * FROM article WHERE id_article = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$id_kategori = $row['ID_CATEGORY'];
$query2 = "SELECT * FROM category_article WHERE id_category = $id_kategori";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);

$id_ahligizi = $row['ID_NUTRITIONIST'];
$query3 = "SELECT * FROM nutritionist WHERE id_nutritionist = $id_ahligizi";
$result3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_assoc($result3);

// komentar
if (isset($_POST['komen'])) {

    if (isset($_POST['komentar'])) {
        $tanggal = date('Y-m-d H:i:s');
        $komentar = $_POST['komentar'];
        $sql_komen = "INSERT INTO comment (id_article, id_patient, comment_date, comment_text) VALUES ('$id', '$id_pasien', '$tanggal', '$komentar')";
        $result = mysqli_query($conn, $sql_komen);
        // var_dump($result);
        // die;
        if (mysqli_affected_rows($conn)) {
            echo " 
            <script>
            alert(Komentar berhasil dikirim...);
            </script>";
        } else {
            echo " 
            <script>
            alert(Komentar gagal dikirim...);
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Artikel Kesehatan</title>
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
            include('sidebar-pasien.php')
            ?>
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card " style="width: 18rem;">
                                <h3 class="mx-auto py-4"><?= $row['TITLE'] ?></h3>
                                <img src="../../images/article/<?= $row['IMAGE_ARTICLE'] ?>" class="card-img-top w-25 mx-auto" alt="gambar-artikel" name="gambar">
                                <div class="card-body ">
                                    <p class="card-text">Kategori : <?= $row2['NAME_CATEGORY'] ?></p>
                                    <br>
                                    <p class="card-text lh-lg"><?= $row['CONTENT_ARTICLE'] ?></p>
                                    <br>
                                    <p class="card-text">Penulis :
                                        <?= $row3['FULLNAME_NUTRITIONIST'] ?></p>
                                    <p class="card-text">Tanggal Publish :
                                        <?= $row['PUBLICATION_DATE'] ?></p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="POST" class="form-sample">

                                        <div class="form-group">
                                            <label class="col-sm-3 col-form-label">Komentar</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="komentar" placeholder="tulis komentar..." required />
                                            </div>
                                            <button type="submit" name="komen" class="btn btn-info mt-4 mb-4">Kirim</button>
                                        </div>
                                    </form>
                                    <?php
                                    $kueri = "SELECT * FROM comment WHERE id_article = $id";
                                    $hasil2 = mysqli_query($conn, $kueri);
                                    if (mysqli_num_rows($hasil2) > 0) {
                                        while ($row = mysqli_fetch_assoc($hasil2)) {

                                            $id_pasien = $row['ID_PATIENT'];
                                            $sql = "SELECT * FROM `patient` WHERE `id_patient` = $id_pasien";
                                            $hasil = mysqli_query($conn, $sql);
                                            $baris = mysqli_fetch_assoc($hasil);
                                            $nama_pasien = $baris['FULLNAME_PATIENT'];


                                    ?>
                                            <div class="form-group">
                                                <ul class="navbar-nav mr-lg-2">
                                                    <li class="nav-item nav-profile dropdown">

                                                        <img src="../../images/faces/face5.jpg" alt="profile" class="rounded-circle" style="width: 50px; height: 50px;" />
                                                        <span class="nav-profile-name mx-2"><?= $nama_pasien ?></span>
                                                        <p class="card-text my-4"><?= $row['COMMENT_TEXT'] ?></p>
                                                        <p class="card-text my-4"><?= $row['COMMENT_DATE'] ?></p>

                                                    </li>

                                                </ul>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>


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
    <!-- End custom js for this page-->
</body>

</html>