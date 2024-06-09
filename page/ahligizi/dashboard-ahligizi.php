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
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->

    <!-- grafik -->
    <script>
      const bulan = <?= json_encode($bulan_konsul) ?>;
      const total_konsultasi = <?= json_encode($total_konsultasi) ?>;
      const labels = bulan;
      const data = {
        labels: labels,
        datasets: [{
          label: 'Total Konsultasi',
          data: total_konsultasi,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
          ],
          borderWidth: 1
        }]
      };
      const config = {
        type: 'bar',
        data: data,
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
            },
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

        },
      };
      const grafik_konsul = document.getElementById('grafik_konsul').getContext('2d');
      new Chart(grafik_konsul, config);
    </script>
    <!-- grafik artikel -->
    <script>
      const tanggal = <?= json_encode($tanggal_publish) ?>;
      const total_artikel = <?= json_encode($total_artikel) ?>;
      const labels2 = bulan;
      const data2 = {
        labels: labels2,
        datasets: [{
          label: 'Total Artikel',
          data: total_artikel,
          backgroundColor: [
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)',
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',

          ],
          borderColor: [
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',

          ],
          borderWidth: 1
        }]
      };
      const config2 = {
        type: 'bar',
        data: data2,
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
            },
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

        },
      };
      const grafik_artikel = document.getElementById('grafik_artikel').getContext('2d');
      new Chart(grafik_artikel, config2);
    </script>
</body>

</html>