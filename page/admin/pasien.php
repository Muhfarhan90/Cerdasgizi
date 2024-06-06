<?php
include("../../logout.php");
include("../../database/database.php");
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
        <!-- <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-mail"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-folder"></i></a>
                </div>
                <div class="nav-link">
                    <a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
                </div> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <!-- <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item ml-0">
                        <h4 class="mb-0">Dashboard</h4>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-baseline">
                            <p class="mb-0">Home</p>
                            <i class="typcn typcn-chevron-right"></i>
                            <p class="mb-0">Main Dahboard</p>
                        </div>
                    </li>
                </ul> -->
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-search d-none d-md-block mr-0">
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
              <h1 class="mb-2 text-titlecase mb-4">Data Pasien</h1>
            </div>
            <div class="col-md-6 grid-margin flex-column text-md-right">
              <a href="tambah-pasien.php"><button type="button" class="btn btn-primary btn-icon-text">
                  <i class="typcn typcn-document btn-icon-prepend"></i>
                  Tambah
                </button></a>

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
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Tinggi (Cm)</th>
                        <th>Berat (Kg)</th>
                        <th>Foto Profil</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      if (!isset($_POST['cari'])) {
                        $query = "SELECT * FROM patient";
                        $result = mysqli_query($conn, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                          <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['FULLNAME_PATIENT'] ?></td>
                            <td><?= $row['EMAIL_PATIENT'] ?></td>
                            <td><?= $row['DATE_OF_BIRTH'] ?></td>
                            <td><?= $row['GENDER'] ?></td>
                            <td><?= $row['HEIGHT'] ?></td>
                            <td><?= $row['WEIGHT'] ?></td>
                            <td><img src="../../images/icons8-user-32.png"></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <a href="edit-pasien.php?id=<?= $row['ID_PATIENT'] ?>"><button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                    Edit
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                  </button></a>
                                <a href="hapus-pasien.php?id=<?= $row['ID_PATIENT'] ?>& id_user=<?= $row['ID_USER'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-icon-text"><button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="hapus-pasien">
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
                        $query = "SELECT * FROM patient WHERE fullname_patient LIKE '%$keyword%'";
                        $result = mysqli_query($conn, $query);
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['FULLNAME_PATIENT'] ?></td>
                            <td><?= $row['EMAIL_PATIENT'] ?></td>
                            <td><?= $row['DATE_OF_BIRTH'] ?></td>
                            <td><?= $row['GENDER'] ?></td>
                            <td><?= $row['HEIGHT'] ?></td>
                            <td><?= $row['WEIGHT'] ?></td>
                            <td><img src="../../images/icons8-user-32.png"></td>
                            <td>
                              <div class="d-flex align-items-center">
                                <a href="edit-pasien.php?id=<?= $row['ID_PATIENT'] ?>"><button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                    Edit
                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                  </button></a>
                                <a href="hapus-pasien.php?id=<?= $row['ID_PATIENT'] ?>& id_user=<?= $row['ID_USER'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-icon-text"><button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="hapus-pasien">
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
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>