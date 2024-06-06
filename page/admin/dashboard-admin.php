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
          <div class="row">
            <div class="card">
              <!-- <div class="card-title">
                <h4>Gender Pasien</h4>
              </div> -->
              <div class="card-body">
                <div>
                  <canvas id="myChart"></canvas>
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
    const ctx = document.getElementById('myChart').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // const config = {
    //   type: 'doughnut',
    //   data: data,
    // };
  </script>
</body>

</html>