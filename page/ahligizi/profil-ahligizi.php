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

          <!-- Form profil -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profil Pengguna</h4>
                  <form class="form-sample">
                    <p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $row['FULLNAME_NUTRITIONIST'] ?>" disabled/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $row['EMAIL_NUTRITIONIST'] ?>" disabled/>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Lama Pengalaman</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $row['YEARS_OF_EXPERIENCE'] ?>" disabled/>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Pendidikan</label>
                          <div class="col-sm-9">
                            <input class="form-control" placeholder="cth: s1 ahligizi" value="<?= $row['EDUCATION'] ?>" disabled/>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Sertifikasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $row['CERTIFICATION'] ?>" disabled/>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Foto Profil</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" value="<?= $row['PROFILE_PICTURE_NUTRITIONIST'] ?>" />
                          </div>
                        </div>
                      </div> -->
                    </div>
                    <a href="edit-profil-ahligizi.php?id=<?= $row['ID_NUTRITIONIST'] ?>">
                      <button type="button" class="btn btn-dark btn-icon-text">
                        Edit
                        <i class="typcn typcn-document btn-icon-append"></i>
                      </button>
                    </a>

                  </form>
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