<?php
include("../../logout.php");
include('../../database/database.php');

// grafik gender pasien
$sql = "
SELECT 
    SUM(CASE WHEN gender = 'L' THEN 1 ELSE 0 END) AS jumlah_laki_laki,
    SUM(CASE WHEN gender = 'P' THEN 1 ELSE 0 END) AS jumlah_perempuan
FROM patient;
";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
  while ($row = $result->fetch_assoc()) {
    $jumlah_laki = $row['jumlah_laki_laki'];
    $jumlah_perempuan = $row['jumlah_perempuan'];
  }


// grafik jumlah konsul ahligizi
$query_ahligizi = "
SELECT 
    nutritionist.fullname_nutritionist,
    COUNT(*) AS jumlah_konsul
FROM 
    consultation
JOIN 
    nutritionist ON consultation.id_nutritionist = nutritionist.id_nutritionist
GROUP BY 
    nutritionist.fullname_nutritionist
ORDER BY 
    jumlah_konsul DESC
LIMIT 5;


";
$result_ahligizi = $conn->query($query_ahligizi);

$ahli_gizi = [];
$jumlah_konsul = [];

if ($result_ahligizi->num_rows > 0) {
  // Fetch data
  while ($row = $result_ahligizi->fetch_assoc()) {
    $ahli_gizi[] = $row["fullname_nutritionist"];
    $jumlah_konsul[] = $row["jumlah_konsul"];
  }
}

// grafik jumlah konsultasi pasien
$query_pasien = "SELECT 
    patient.fullname_patient,
    COUNT(*) AS total_konsultasi
FROM 
    consultation
JOIN 
    patient ON consultation.id_patient = patient.id_patient
GROUP BY 
    patient.fullname_patient
ORDER BY 
    total_konsultasi DESC
LIMIT 5;
";
$result_pasien = $conn->query($query_pasien);

$pasien = [];
$total_konsul = [];

if ($result_pasien->num_rows > 0) {
  // Fetch data
  while ($row = $result_pasien->fetch_assoc()) {
    $pasien[] = $row["fullname_patient"];
    $total_konsul[] = $row["total_konsultasi"];
  }
}


// grafik artikel
$query_artikel = "SELECT nutritionist.fullname_nutritionist, COUNT(*) AS jumlah_artikel FROM article JOIN nutritionist ON article.id_nutritionist = nutritionist.id_nutritionist GROUP BY nutritionist.fullname_nutritionist ORDER BY jumlah_artikel DESC LIMIT 5";
$result_artikel = mysqli_query($conn, $query_artikel);
$artikel = [];
$jumlah_artikel = [];
if ($result_artikel->num_rows > 0) {
  while ($row = $result_artikel->fetch_assoc()) {
    $artikel[] = $row['fullname_nutritionist'];
    $jumlah_artikel[] = $row['jumlah_artikel'];
  }
}

// grafik bulan
$query_konsul = "
SELECT 
    DATE_FORMAT(date_consultation, '%Y-%m') AS month,
    COUNT(*) AS total_konsultasi
FROM 
    consultation
GROUP BY 
    DATE_FORMAT(date_consultation, '%Y-%m')
ORDER BY 
    DATE_FORMAT(date_consultation, '%Y-%m');
";

$result_konsul = $conn->query($query_konsul);

$months = [];
$total_konsultasi = [];

if ($result_konsul->num_rows > 0) {
  while ($row = $result_konsul->fetch_assoc()) {
    $months[] = $row["month"];
    $total_konsultasi[] = $row["total_konsultasi"];
  }
}

// grafik artikel yg paling bnyk komentar
$query_komen = "SELECT article.id_article AS id_artikel, article.title AS judul_artikel, COUNT(comment.id_article) AS total_komentar
FROM article
LEFT JOIN comment ON article.id_article = comment.id_article
GROUP BY article.id_article LIMIT 5;";
$result_komen = mysqli_query($conn, $query_komen);

$judul = [];
$total_komen = [];
if ($result_komen->num_rows > 0) {
  while ($row = $result_komen->fetch_assoc()) {
    $judul[] = $row['judul_artikel'];
    $total_komen[] = $row['total_komentar'];
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
    include('navbar-admin.php');
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
      include('sidebar-admin.php');
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
            <!-- pasien -->
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card bg-success">
                <div class="card-body">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Pasien</p>
                      <h1 class="mb-0">
                        <?php
                        $query = "SELECT COUNT(*) as total FROM patient";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $total_rows = $row['total'];
                          echo "$total_rows";
                        } else {
                          echo "0";
                        }
                        ?>
                      </h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-light"></i>
                  </div>
                  <canvas id="expense-chart" height="186" width="698" style="display: block; height: 149px; width: 559px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <!-- ahligizi -->
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card bg-secondary">
                <div class="card-body">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Ahligizi</p>
                      <h1 class="mb-0">
                        <?php
                        $query = "SELECT COUNT(*) as total FROM nutritionist";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $total_rows = $row['total'];
                          echo "$total_rows";
                        } else {
                          echo "0";
                        }
                        ?>
                      </h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-light"></i>
                  </div>
                  <canvas id="expense-chart" height="186" width="698" style="display: block; height: 149px; width: 559px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <!-- konsultasi -->
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card bg-warning">
                <div class="card-body">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Konsultasi</p>
                      <h1 class="mb-0">
                        <?php
                        $query = "SELECT COUNT(*) as total FROM consultation";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $total_rows = $row['total'];
                          echo "$total_rows";
                        } else {
                          echo "0";
                        }
                        ?>
                      </h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-light"></i>
                  </div>
                  <canvas id="expense-chart" height="186" width="698" style="display: block; height: 149px; width: 559px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
            <!-- artikel -->
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card bg-info">
                <div class="card-body">
                  <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                      <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink">
                      <div class=""></div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total Artikel</p>
                      <h1 class="mb-0">
                        <?php
                        $query = "SELECT COUNT(*) as total FROM article";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);
                          $total_rows = $row['total'];
                          echo "$total_rows";
                        } else {
                          echo "0";
                        }
                        ?>
                      </h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-light"></i>
                  </div>
                  <canvas id="expense-chart" height="186" width="698" style="display: block; height: 149px; width: 559px;" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!-- GRAFIK -->
          <div class="row">
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart"></canvas>
                  </div>

                </div>

              </div>
            </div>
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart3"></canvas>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- GRAFIK ROW 2 -->
          <div class="row">
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart4"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart5"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div>
                    <canvas id="myChart6"></canvas>
                  </div>
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
  <script>
    //  grafik gender pasien
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: [
          'Jumlah Laki',
          'Jumlah Perempuan',
        ],
        datasets: [{
          label: 'Total',
          data: [
            <?= $jumlah_laki ?>,
            <?= $jumlah_perempuan ?>
          ],
          backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
          ],
          hoverOffset: 4,
          borderWidth: 1,
          borderColor: 'black'

        }],

      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Data Gender Pasien'
          },
        },
        scales: {


        },

      }
    });
  </script>
  <script>
    // grafik 2
    var ahliGiziData = <?= json_encode($ahli_gizi) ?>;
    var jumlahKonsulData = <?= json_encode($jumlah_konsul) ?>;
    // Calculate the maximum value in the dataset
    var maxKonsul = Math.max.apply(Math, jumlahKonsulData);

    // Round up the maximum value to the nearest integer
    var roundedMaxKonsul = Math.ceil(maxKonsul);
    const ctx2 = document.getElementById('myChart2');
    new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ahliGiziData,
        datasets: [{
          label: 'Total',
          data: jumlahKonsulData,
          backgroundColor: [
            'red',
            'blue',
            'yellow',
            'green',
            'purple'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1,

        }],

      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Jumlah Konsultasi Ahligizi'
          },
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1,
            min: 0,
            max: roundedMaxKonsul,
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
      }
    });
  </script>

  <!-- grafik konsultasi pasien  -->
  <script>
    var pasienData = <?= json_encode($pasien) ?>;
    var totalKonsultasi = <?= json_encode($total_konsul) ?>;
    // Calculate the maximum value in the dataset
    var maxKonsul = Math.max.apply(Math, totalKonsultasi);

    // Round up the maximum value to the nearest integer
    var roundedMaxKonsul = Math.ceil(maxKonsul);
    const ctx3 = document.getElementById('myChart3');
    new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: pasienData,
        datasets: [{
          label: 'Total',
          data: totalKonsultasi,
          backgroundColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1,

        }],

      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Jumlah Konsultasi Pasien'
          },
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1,
            min: 0,
            max: roundedMaxKonsul,
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

  <!-- Grafik artikel -->
  <script>
    var dataArtikel = <?= json_encode($artikel) ?>;
    var jumlah_artikel = <?= json_encode($jumlah_artikel) ?>;
    // Calculate the maximum value in the dataset
    var maxArtikel = Math.max.apply(Math, jumlah_artikel);

    // Round up the maximum value to the nearest integer
    var roundedMaxArtikel = Math.ceil(maxArtikel);
    const ctx4 = document.getElementById('myChart4');
    new Chart(ctx4, {
      type: 'bar',
      data: {
        labels: dataArtikel,
        datasets: [{
          label: 'Total',
          data: jumlah_artikel,
          backgroundColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1,

        }],

      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Jumlah Artikel Ahligizi'
          },
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            stepSize: 1,
            min: 0,
            max: roundedMaxArtikel,

          },
          x: {
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
        indexAxis: 'y'

      }
    });
  </script>

  <!-- grafik 5 -->
  <script>
    var months = <?= json_encode($months) ?>;
    var totalKonsultasi = <?= json_encode($total_konsultasi) ?>;
    const data = {
      labels: months,
      datasets: [{
        label: 'Total Konsultasi',
        data: totalKonsultasi,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
      }]
    };
    const config = {
      type: 'line',
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
              stepSize: 1
            }
          }
        },
      }
    };
    const ctx5 = document.getElementById('myChart5').getContext('2d');
    var chart5 = new Chart(ctx5, config);
  </script>

  <script>
    // grafik artikel paling banyak komentar
    var judul = <?= json_encode($judul) ?>;
    var totalKomen = <?= json_encode($total_komen) ?>;
    const label2 = judul
    const data2 = {
      labels: label2,
      datasets: [{
        label: 'Total Komentar',
        data: totalKomen,
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
    const config2 = {
      type: 'bar',
      data: data2,
      options: {
        scales: {
          y: {
            beginAtZero: true,

          },
          x: {
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
        indexAxis: 'y',

      },
      title: {
        display: true,
        text: 'Total Artikel Komen Terbanyak'
      }

    };
    const ctx6 = document.getElementById('myChart6').getContext('2d');
    new Chart(ctx6, config2);
  </script>
</body>

</html>