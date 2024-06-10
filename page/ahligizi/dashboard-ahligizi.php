<?php
include("../../logout.php");
include('../../database/database.php');
// mendapatkan id_ahligizi
$id_user = $_SESSION['id_user'];
$query_ahligizi = "SELECT * FROM nutritionist WHERE id_user = $id_user";
$result_ahligizi = mysqli_query($conn, $query_ahligizi);
$row = mysqli_fetch_assoc($result_ahligizi);
$id_ahligizi = $row['ID_NUTRITIONIST'];
// grafik konsultasi
$query_konsultasi = "SELECT DATE_FORMAT(date_consultation, '%Y-%m') AS bulan, COUNT(*) AS total_konsultasi FROM consultation WHERE id_nutritionist = $id_ahligizi GROUP BY bulan ORDER BY bulan ";
$result_konsultasi = mysqli_query($conn, $query_konsultasi);
$bulan_konsul = [];
$total_konsultasi = [];
if ($result_konsultasi->num_rows > 0) {
  while ($row = $result_konsultasi->fetch_assoc()) {
    $bulan_konsul[] = $row['bulan'];
    $total_konsultasi[] = $row['total_konsultasi'];
  }
}

// grafik artikel
$query_artikel = "SELECT DATE_FORMAT(publication_date, '%Y-%m') AS tanggal, COUNT(*) AS total_artikel FROM article WHERE id_nutritionist = $id_ahligizi GROUP BY tanggal ORDER BY tanggal";
$result_artikel = mysqli_query($conn, $query_artikel);
$tanggal_publish = [];
$total_artikel = [];
if ($result_artikel->num_rows > 0) {
  while ($row = $result_artikel->fetch_assoc()) {
    $tanggal_publish[] = $row['tanggal'];
    $total_artikel[] = $row['total_artikel'];
  }
}
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
          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
              <h1 class="mb-2 text-titlecase mb-4">SELAMAT DATANG<?= " " . $_SESSION['username_user'] ?></h1>
            </div>
          </div>
          <!-- Grafik -->
          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="grafik_konsul"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <!-- grafik artikel -->
            <div class="col-xl-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="grafik_artikel"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- grafik -->
    <script>
      const bulan = <?= json_encode($bulan_konsul) ?>;
      const total_konsultasi = <?= json_encode($total_konsultasi) ?>;
      const grafik_konsul = document.getElementById('grafik_konsul').getContext('2d');
      new Chart(grafik_konsul, {
        type: 'bar',
        data: {
          labels: bulan,
          datasets: [{
            label: 'Total Konsultasi',
            data: total_konsultasi,
            borderWidth: 1,
            backgroundColor: ['#365E32', '#81A263', '#E7D37F', '#FD9B63']
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  if (Number.isInteger(value)) {
                    return value;
                  }
                },
                stepSize: 1,
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: 'Total Konsultasi Yang Dilakukan'
            },
            legend: {
              display: false
            }
          }
        }
      });
    </script>
    <!-- grafik artikel -->
    <script>
      const grafik_artikel = document.getElementById('grafik_artikel').getContext('2d');

      const tanggal = <?= json_encode($tanggal_publish) ?>;
      const total_artikel = <?= json_encode($total_artikel) ?>;
      new Chart(grafik_artikel, {
        type: 'bar',
        data: {
          labels: tanggal,
          datasets: [{
            label: 'Total Artikel',
            data: total_artikel,
            borderWidth: 1,
            backgroundColor: ['#050C9C', '#3572EF', '#3ABEF9', '#A7E6FF']
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                callback: function(value) {
                  if (Number.isInteger(value)) {
                    return value;
                  }
                },
                stepSize: 1,
              }
            }
          },
          plugins: {
            title: {
              display: true,
              text: 'Total Artikel Yang Dibuat'
            },
            legend: {
              display: false
            }
          }
        }
      });
    </script>
</body>

</html>