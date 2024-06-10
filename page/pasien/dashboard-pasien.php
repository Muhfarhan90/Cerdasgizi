<?php
include("../../logout.php");
include('../../database/database.php');
$id_user = $_SESSION['id_user'];
$query_pasien = "SELECT * FROM patient WHERE id_user = $id_user";
$result_pasien = mysqli_query($conn, $query_pasien);
$row = mysqli_fetch_assoc($result_pasien);
$id_pasien = $row['ID_PATIENT'];

// grafik Imt
$query_imt = "SELECT result_bmi, DATE_FORMAT(date_check_bmi, '%Y-%m-%d') AS bulan
FROM bmi_calculator
WHERE id_patient = $id_pasien
ORDER BY bulan;";
$result_imt = mysqli_query($conn, $query_imt);

$hasil_bmi = [];
$cek_bmi = [];
if ($result_imt->num_rows > 0) {
  while ($row = $result_imt->fetch_assoc()) {
    $hasil_bmi[] = $row['result_bmi'];
    $cek_bmi[] = $row['bulan'];
  }
}

// grafik konsultasi
$query_konsultasi = "SELECT DATE_FORMAT(date_consultation, '%Y-%m') AS bulan, COUNT(*) AS total_konsultasi FROM consultation WHERE id_patient = $id_pasien GROUP BY bulan ORDER BY bulan ";
$result_konsultasi = mysqli_query($conn, $query_konsultasi);

$bulan_konsul = [];
$total_konsultasi = [];
if ($result_konsultasi->num_rows > 0) {
  while ($row = $result_konsultasi->fetch_assoc()) {
    $bulan_konsul[] = $row['bulan'];
    $total_konsultasi[] = $row['total_konsultasi'];
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
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
  <style>
    th,
    td {
      padding: 0.5rem;
    }
  </style>
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
              <h1 class="mb-2 text-titlecase mb-4">SELAMAT DATANG<?= " " . $_SESSION['username_user'] ?></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="grafikIMT"></canvas>
                  </div>
                  <div style="margin-top: 1rem;">
                    <table border="1">
                      <tr>
                        <th>Nilai Imt</th>
                        <th>Artinya</th>
                      </tr>
                      <tr>
                        <td>18.4 ke bawah</td>
                        <td>Berat badan kurang</td>
                      </tr>
                      <tr>
                        <td>18.5 - 24.9</td>
                        <td>Berat badan Ideal</td>
                      </tr>
                      <tr>
                        <td>25 - 29.9</td>
                        <td>Berat badan lebih</td>
                      </tr>
                      <tr>
                        <td>30 - 39.9</td>
                        <td>Gemuk</td>
                      </tr>
                      <tr>
                        <td>40 ke atas</td>
                        <td>Sangat Gemuk</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="grafik_konsultasi"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div>
              <h1>Artikel Terbaru </h1>

            </div>
          </div>
          <div class="row">
            <?php
            $query = "SELECT * FROM article ORDER BY publication_date DESC LIMIT 4";
            $result = mysqli_query($conn, $query);
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
        </div>

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  </div>
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


  <!-- GRAFIKK IMT-->
  <script>
    const tanggal = <?= json_encode($cek_bmi); ?>;
    const hasil = <?= json_encode($hasil_bmi); ?>;

    const grafik_imt = document.getElementById('grafikIMT');

    new Chart(grafik_imt, {
      type: 'line',
      data: {
        labels: tanggal,
        datasets: [{
          label: 'Indeks Masa Tubuh',
          data: hasil,
          borderWidth: 1
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
              stepSize: 1
            }
          }
        }
      }
    });
  </script>
  <!-- Grafik Konsultasi Yang DIlakukan -->
  <script>
    const grafik_konsultasi = document.getElementById('grafik_konsultasi');
    const bulan_konsul = <?= json_encode($bulan_konsul) ?>;
    const total_konsultasi = <?= json_encode($total_konsultasi) ?>;
    console.log(bulan_konsul);
    console.log(total_konsultasi);
    new Chart(grafik_konsultasi, {
      type: 'bar',
      data: {
        labels: bulan_konsul,
        datasets: [{
          label: 'Total Konsultasi',
          data: total_konsultasi,
          borderWidth: 1,
          backgroundColor: ['#059212','#06D001','#9BEC00','#F3FF90']
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
              stepSize: 1
            }
          }
        },
        plugins : {
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
</body>

</html>