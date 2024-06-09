<?php
include("../../logout.php");
include("../../database/database.php");

// if (isset($_POST['cari'])) {
//   $katakunci = $_POST['katakunci'];

//   $query = "SELECT * FROM nutritionist WHERE `FULLNAME_NUTRITIONIST` = '$katakunci'";
//   $result = mysqli_query($conn, $query);
// }
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
    <!-- Fitur Search -->
    <nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
      <div class="navbar-links-wrapper d-flex align-items-stretch">
        <!-- Optional links here -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-search d-block d-md-none w-100"> <!-- Mobile View -->
            <form action="" method="POST" class="w-100">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search" name="katakunci">
                <div class="input-group-prepend">
                  <button class="input-group-text" id="search" type="submit" name="cari">
                    <i class="typcn typcn-zoom"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
          <li class="nav-item nav-search d-none d-md-block mr-0"> <!-- Desktop View -->
            <form action="" method="POST">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="search" name="katakunci">
                <div class="input-group-prepend">
                  <button class="input-group-text" id="search" type="submit" name="cari">
                    <i class="typcn typcn-zoom"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </div>
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
      include('sidebar-admin.php');
      ?>
      <!-- partial -->
      <div class="main-panel">

        <div class="content-wrapper">
          <!-- Judul fitur -->
          <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <h1 class="mb-2 text-titlecase mb-4">Data Ahligizi</h1>
            </div>
            <div class="col-md-6 grid-margin flex-column text-md-right">
              <a href="tambah-ahligizi.php">
                <button type="button" class="btn btn-primary btn-icon-text">
                  <i class="typcn typcn-document btn-icon-prepend"></i>
                  Tambah
                </button>
              </a>


            </div>
          </div>
          <!-- Tabel CRUD -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table">
                    <thead>
                      <tr>
                        <th class="ml-5">NO</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tahun Pengalaman</th>
                        <th>Pendidikan</th>
                        <th>Sertifikasi</th>
                        <th>Foto Profil</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if (!isset($_POST['cari'])) {

                        $query = "SELECT * FROM nutritionist";
                        $result = mysqli_query($conn, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['FULLNAME_NUTRITIONIST'] ?></td>
                            <td><?= $row['EMAIL_NUTRITIONIST'] ?></td>
                            <td><?= $row['YEARS_OF_EXPERIENCE'] ?></td>
                            <td><?= $row['EDUCATION'] ?></td>
                            <td><?= $row['CERTIFICATION'] ?></td>
                            <td>
                              <img src="../../images/icons8-doctor-32.png" alt="profil">
                            </td>
                            <td>
                              <div class="d-flex align-items-center">
                                <a href="edit-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>"> <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                    Edit
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                  </button></a>
                                <a href="hapus-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>&id_user=<?= $row['ID_USER'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ahli gizi?')"> <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                    Delete
                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                  </button></a>

                              </div>
                            </td>
                          </tr>
                        <?php
                          $i++;
                        }
                      } else {
                        $keyword = $_POST['katakunci'];
                        $query = "SELECT * FROM nutritionist WHERE `FULLNAME_NUTRITIONIST` LIKE '%$keyword%'";
                        $result = mysqli_query($conn, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['FULLNAME_NUTRITIONIST'] ?></td>
                            <td><?= $row['EMAIL_NUTRITIONIST'] ?></td>
                            <td><?= $row['YEARS_OF_EXPERIENCE'] ?></td>
                            <td><?= $row['EDUCATION'] ?></td>
                            <td><?= $row['CERTIFICATION'] ?></td>
                            <td>
                              <img src="../../images/icons8-doctor-32.png" alt="profil">
                            </td>
                            <td>
                              <div class="d-flex align-items-center">
                                <a href="edit-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>"> <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                    Edit
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                  </button></a>
                                <a href="hapus-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>&id_user=<?= $row['ID_USER'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ahli gizi?')"> <button type="button" class="btn btn-danger btn-sm btn-icon-text">
                                    Delete
                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                  </button></a>

                              </div>
                            </td>
                          </tr>
                      <?php
                          $i++;
                        }
                      }


                      ?>

                  
                    </tbody>
                  </table>
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