<?php
include('../../database/database.php');
include("../../logout.php");

if (!isset($_SESSION['is_login']) && $_SESSION['id_role'] == 3 || $_SESSION['id_role'] == 1) {
  header('Location: index.php');
  exit();
}

$user_id = $_SESSION['id_user'];
$query = "SELECT * FROM nutritionist WHERE id_user = $user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Profil Pasien</title>
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
    include('navbar-ahligizi.php');
    ?>
    <!-- partial -->

    </nav>
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
              <h1 class="mb-2 text-titlecase mb-4">Tambah Artikel</h1>
            </div>
          </div>

          <!-- Form tambah profil -->


          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Masukkan data artikel !</h4>
                  <form class="forms-sample" method="POST" action="proses-tambah-artikel.php">
                    <div class="form-group">
                      <label for="exampleInputName1">Judul Artikel</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="judul" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Isi Artikel</label>
                      <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="konten"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="dropdown">Pilih Kategori</label>
                      <select class="form-control" id="dropdown" name="kategori">
                        <?php
                        $sql = "SELECT * FROM category_article";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?= $row['ID_CATEGORY'] ?>"><?= $row['NAME_CATEGORY'] ?></option>
                        <?php
                          }
                        }
                        ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Gambar Artikel</label>
                      <input type="file" class="form-control" id="exampleInputEmail3" name="gambar" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Tanggal Publish</label>
                      <input type="date" class="form-control" id="exampleInputEmail3" name="tanggal" placeholder="Password" value="<?php
                                                                                                                                    $tanggal = date('Y-m-d');
                                                                                                                                    echo "$tanggal";
                                                                                                                                    ?>" disabled>
                    </div>



                    <button type="submit" class="btn btn-primary mr-2" name="tambah-artikel">Tambah</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <!-- partial -->
        </div>
        <!-- main-panel ends -->
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