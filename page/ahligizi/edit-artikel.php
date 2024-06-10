<?php
include("../../logout.php");
include("../../database/database.php");

// id_ahligizi
$id_user = $_SESSION['id_user'];
$query_ahligizi = "SELECT * FROM NUTRITIONIST WHERE id_user = $id_user";
$result_ahligizi = mysqli_query($conn, $query_ahligizi);
$row_ahligizi = mysqli_fetch_assoc($result_ahligizi);
$id_ahligizi = $row_ahligizi['ID_NUTRITIONIST'];

// id artikel
$id = $_GET['id'];
$query = "SELECT * FROM article WHERE id_article = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// id kategori artikel
$id_kategori = $row['ID_CATEGORY'];
$query_kat = "SELECT * FROM CATEGORY_ARTICLE";
$result_kat = mysqli_query($conn, $query_kat);

$categories = [];
while ($row_kat = mysqli_fetch_assoc($result_kat)) {
    $categories[] = $row_kat;
}

// jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $konten = $_POST['konten'];
    $gambar = $_POST['gambar']; // Assuming the image URL is passed here
    $tanggal = date('Y-m-d H:i:s');

    $query2 = "UPDATE `article` SET `title` = '$judul', `id_category` = '$kategori', id_nutritionist = $id_ahligizi, `image_article` = '$gambar', `content_article` = '$konten', `publication_date` = '$tanggal' WHERE `id_article` = $id";
    $result2 = mysqli_query($conn, $query2);
    $row_affected = mysqli_affected_rows($conn);
    if ($row_affected > 0) {
        echo "<script>alert('Data berhasil diubah...');
        document.location.href = 'artikel-ahligizi.php'
        </script>";
    } else {
        echo "<script>alert('Data gagal diubah...');
        document.location.href = 'artikel-ahligizi.php'
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Admin</title>
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
        include('navbar-ahligizi.php');
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
            include('sidebar-ahligizi.php');
            ?>
            <!-- partial -->
            <div class="main-panel">

                <div class="content-wrapper">
                    <!-- Judul fitur -->
                    <div class="row">

                        <div class="col-xl-6 grid-margin stretch-card flex-column">
                            <h1 class="mb-2 text-titlecase mb-4">Edit Data Artikel</h1>
                        </div>
                    </div>

                    <!-- form ubah artikel -->
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Masukkan Data Baru Artikel</h4>
                                    <form class="forms-sample" action="" method="POST">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Judul Artikel</label>
                                            <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?= $row['TITLE'] ?>" name="judul">
                                        </div>

                                        <div class="form-group">
                                            <label for="kategori">Kategori Artikel</label>
                                            <select class="form-control" name="kategori" id="kategori">
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?= $category['ID_CATEGORY'] ?>" <?= $category['ID_CATEGORY'] == $id_kategori ? 'selected' : '' ?>><?= $category['NAME_CATEGORY'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Isi Artikel</label>
                                            <textarea rows="8" class="form-control" name="konten" id="exampleInputPassword4"><?= $row['CONTENT_ARTICLE'] ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputCity1">Gambar Artikel</label>
                                            <input type="file" class="form-control" id="exampleInputCity1" placeholder="URL Gambar" value="<?= $row['IMAGE_ARTICLE'] ?>" name="gambar">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCity1">Tanggal Perubahan</label>
                                            <input type="text" class="form-control" id="exampleInputCity1" value="<?php echo date('Y-m-d H:i:s'); ?>" disabled>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="simpan">Simpan</button>
                                        <button type="button" class="btn btn-light" onclick="window.location.href='artikel-ahligizi.php'">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- partial -->
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