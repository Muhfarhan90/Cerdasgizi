<?php
include("../../logout.php");
include('../../database/database.php');
// pasien
$id_user = $_SESSION['id_user'];
$query_pasien = "SELECT * FROM patient WHERE id_user = $id_user";
$result_pasien = mysqli_query($conn, $query_pasien);
$row_pasien = mysqli_fetch_assoc($result_pasien);



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Konsultasi</title>
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
              <h1 class="mb-2 text-titlecase mb-4">Konsultasi</h1>
            </div>
          </div>

          <div class="row">
            <div class="col-xl-12 grid-margin stretch-card flex-column">
              <div class="card">
                <?php
                // Mendapatkan nilai id_patient terakhir
                $query_last_id_consultation = "SELECT MAX(id_consultation) AS last_id_consultation FROM consultation";
                $result_last_id_consultation = mysqli_query($conn, $query_last_id_consultation);
                $row_last_id_consultation = mysqli_fetch_assoc($result_last_id_consultation);
                $last_id_consultation = $row_last_id_consultation['last_id_consultation'];

                // Mengatur id_user dan id_nutritionist untuk data berikutnya
                $id_consultation = $last_id_consultation + 1;
                $no = 1;
                if (isset($_GET['ajukan'])) {
                  $id_pasien = $row_pasien['ID_PATIENT'];
                  // ahligizi
                  $id_ahligizi = $_GET['id_ahligizi'];
                  // tanggal
                  $tanggal = date('Y-m-d H:i:s');
                  $status = "sedang menunggu";

                  $query = "INSERT INTO consultation (id_consultation, id_patient, id_nutritionist, date_consultation, status_consultation) VALUES ($id_consultation, $id_pasien, $id_ahligizi, '$tanggal', '$status')";
                  $result = mysqli_query($conn, $query);



                  if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>
                      alert('data konsultasi berhasil ditambah');
                    </script>";
                  }
                }
                ?>
                <!-- <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>Nama Ahligizi</th>
                      <th>Tanggal Konsultasi</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <?php
                  $id_pasien = $row_pasien['ID_PATIENT'];
                  $status = "sedang menunggu";
                  // select 3 tabel
                  $query2 = "SELECT consultation.id_consultation, patient.fullname_patient, nutritionist.fullname_nutritionist, consultation.DATE_CONSULTATION, consultation.STATUS_CONSULTATION FROM consultation
                  INNER JOIN patient ON consultation.id_patient = patient.id_patient
                  INNER JOIN nutritionist ON consultation.id_nutritionist = nutritionist.id_nutritionist
                  WHERE consultation.id_patient = $id_pasien AND consultation.STATUS_CONSULTATION = '$status'";
                  $result2 = mysqli_query($conn, $query2);
                  if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                  ?>
                      <tbody>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $row2['fullname_patient'] ?></td>
                          <td><?= $row2['fullname_nutritionist'] ?></td>
                          <td><?= $row2['DATE_CONSULTATION'] ?></td>
                          <td><label class="badge badge-warning"><?= $row2['STATUS_CONSULTATION'] ?></label></td>
                        </tr>
                      </tbody>
                  <?php
                      $no++;
                    }
                  }
                  ?>
                </table> -->
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pasien</th>
                      <th>Nama Ahli Gizi</th>
                      <th>Tanggal Konsultasi</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <?php
                  $id_pasien = $row_pasien['ID_PATIENT'];
                  $statuses = ["sedang menunggu", "dalam proses", "selesai"];
                  $query2 = "SELECT consultation.id_consultation, patient.fullname_patient, nutritionist.fullname_nutritionist, consultation.DATE_CONSULTATION, consultation.STATUS_CONSULTATION 
             FROM consultation
             INNER JOIN patient ON consultation.id_patient = patient.id_patient
             INNER JOIN nutritionist ON consultation.id_nutritionist = nutritionist.id_nutritionist
             WHERE consultation.id_patient = $id_pasien 
             AND consultation.STATUS_CONSULTATION IN ('" . implode("','", $statuses) . "')";
                  $result2 = mysqli_query($conn, $query2);
                  if (mysqli_num_rows($result2) > 0) {
                    $no = 1;
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                  ?>
                      <tbody>
                        <tr>
                          <td><?= $no ?></td>
                          <td><?= $row2['fullname_patient'] ?></td>
                          <td><?= $row2['fullname_nutritionist'] ?></td>
                          <td><?= $row2['DATE_CONSULTATION'] ?></td>
                          <td>
                            <?php
                            if ($row2['STATUS_CONSULTATION'] == "sedang menunggu") {
                              echo '<label class="badge badge-warning">' . $row2['STATUS_CONSULTATION'] . '</label>';
                            } elseif ($row2['STATUS_CONSULTATION'] == "dalam proses") {
                              echo '<label class="badge badge-primary">' . $row2['STATUS_CONSULTATION'] . '</label>';
                            } elseif ($row2['STATUS_CONSULTATION'] == "selesai") {
                              echo '<label class="badge badge-success">' . $row2['STATUS_CONSULTATION'] . '</label>';
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            if ($row2['STATUS_CONSULTATION'] == "dalam proses") {
                              echo '<a href="chat.php?id_consultation=' . $row2['id_consultation'] . '" class="btn btn-info">Buka Chat</a>';
                            } elseif ($row2['STATUS_CONSULTATION'] == "selesai") {
                              echo '<a href="history.php?id_consultation=' . $row2['id_consultation'] . '" class="btn btn-secondary">Lihat Riwayat</a>';
                            } else {
                              echo '-';
                            }
                            ?>
                          </td>
                        </tr>
                      </tbody>
                  <?php
                      $no++;
                    }
                  }
                  ?>
                </table>

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