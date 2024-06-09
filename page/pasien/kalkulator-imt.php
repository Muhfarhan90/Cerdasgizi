<?php
include("../../logout.php");
include('../../database/database.php');

$id = $_SESSION['id_user'];
$tanggal = date('Y-m-d');
$kategori = "";
if (isset($_POST['hitung'])) {
  $tinggi = $_POST['tinggi'];
  $berat = $_POST['berat'];

  // validasi
  if (is_numeric($tinggi) && is_numeric($berat) && $tinggi > 0 && $berat > 0) {
    $hasil = round($berat / (($tinggi / 100) * ($tinggi / 100)), 2);
    if ($hasil < 18.4) {
      $kategori = "Berat badan kurang";
    } else if ($hasil >= 18.4 && $hasil <= 24.9) {
      $kategori = "Berat badan ideal";
    } else if ($hasil >= 25 && $hasil <= 29.9) {
      $kategori = "Berat badan lebih";
    } else if ($hasil >= 30 && $hasil <= 39.9) {
      $kategori = "Gemuk";
    } else if ($hasil >= 40) {
      $kategori = "Sangat gemuk";
    } else {
      echo "Inputan anda melebihi batas";
    }
  } else {
    echo "Inputan anda harus lebih dari 0";
  }
  $query2 = "SELECT * FROM patient WHERE id_user = $id";
  $result2 = mysqli_query($conn, $query2);
  $row = mysqli_fetch_assoc($result2);
  $id_pasien = $row['ID_PATIENT'];
  // insert database
  $query = "INSERT INTO bmi_calculator (`id_patient`, `date_check_bmi`, `height_bmi`, `weight_bmi`, `result_bmi`, `category_bmi`) VALUES ('$id_pasien', '$tanggal', '$tinggi', '$berat', '$hasil', '$kategori')";
  $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Indeks Masa Tubuh</title>
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

      <!-- parti<al -->

      <?php
      include('sidebar-pasien.php');
      ?>
      <div class="main-panel">

        <div class="content-wrapper">

          <!-- Form Ubah profil -->
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Kalkulator Indeks Masa Tubuh</h4>
                  <p class="card-description">
                    Masukkan tinggi badan, berat badan, dan usia anda !
                  </p>
                  <form class="forms-sample" action="" method="POST">
                    <div class="form-group">
                      <label for="exampleInputName1">Tinggi Badan (cm)</label>
                      <input type="number" class="form-control" id="exampleInputName1" placeholder="tinggi" name="tinggi">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Berat Badan (kg)</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" placeholder="berat" name="berat">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Tanggal Cek Indeks Masa Tubuh</label>
                      <input type="date" class="form-control" id="exampleInputPassword4" value="<?= $tanggal ?>" disabled>
                    </div>

                    <p class="card-description">
                      Tekan hitung untuk dapat mengetahui hasil nilai IMT dan kategori IMT anda !
                    </p>
                    <button type="submit" class="btn btn-primary mr-2" name="hitung">Hitung</button>
                    <button class="btn btn-light">Reset</button>
                    <div class="form-group"></div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Hasil Nilai IMT</label>
                      <input type="number" class="form-control" id="exampleInputEmail3" placeholder="hasil" name="hasil" value="<?= $hasil ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Kategori</label>
                      <input type="text" class="form-control" id="exampleInputEmail3" placeholder="kategori" value="<?= $kategori ?>">
                    </div>
                  </form>
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