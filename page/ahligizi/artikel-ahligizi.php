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
          <div class="row">
            <div class="col-md-6 grid-margin flex-column text-md-left">
              <h1>Artikel Kesehatan</h1>

            </div>
            <div class="col-md-6 grid-margin flex-column text-md-right">
              <a href="tambah-artikel.php"><button type="button" class="btn btn-primary btn-icon-text">
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
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Gambar</th>
                        <th>Tanggal Publish</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $id_nutritionist = $row['ID_NUTRITIONIST'];
                      $query = "SELECT * FROM article WHERE id_nutritionist = $id_nutritionist";
                      $result = mysqli_query($conn, $query);
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        $content = $row['CONTENT_ARTICLE'];
                        $excerpt = substr($content, 0 , 30);
                      ?>
                        <tr>
                          <td><?= $i ?></td>
                          <td><?= $row['ID_CATEGORY'] ?></td>
                          <td><?= $row['TITLE'] ?></td>
                          <td><?= $excerpt ?></td>
                          <td><?= $row['IMAGE_ARTICLE'] ?></td>
                          <td><?= $row['PUBLICATION_DATE'] ?></td>
                          <td>
                            <div class="d-flex align-items-center">
                              <a href="edit-artikel.php?id=<?= $row['ID_ARTICLE'] ?>"><button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                  Edit
                                  <i class="typcn typcn-edit btn-icon-append"></i>
                                </button></a>
                              <a href="hapus-artikel.php?id=<?= $row['ID_ARTICLE'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="btn btn-icon-text"><button type="submit" class="btn btn-danger btn-sm btn-icon-text" name="hapus-pasien">
                                  Delete
                                  <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                </button></a>

                            </div>
                          </td>
                        </tr>
                      <?php
                        $i++;
                      }

                      ?>


                    </tbody>
                  </table>
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
</body>

</html>