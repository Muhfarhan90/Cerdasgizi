<?php
include("../../logout.php");
include("../../database/database.php");

$id = $_GET['id'];
// query select untuk menampilkan isi field dari ID yang dipilih
$query = "SELECT * FROM nutritionist WHERE id_nutritionist = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $pengalaman = $_POST['pengalaman'];
  $edukasi = $_POST['edukasi'];
  $sertifikasi = $_POST['sertifikasi'];

  $query2 = "UPDATE `nutritionist` SET `email_nutritionist` = '$email', `fullname_nutritionist` = '$nama', `years_of_experience` = '$pengalaman', `education` = '$edukasi', `certification` = '$sertifikasi' WHERE `id_nutritionist` = $id";
  $result2 = mysqli_query($conn, $query2);
  $row = mysqli_affected_rows($conn);
  if ($row > 0) {
    echo "<script>
      alert('Data berhasil diubah...');
    </script>";
    header("location: ahligizi.php");
  } else {
    echo "<script>
    alert('Data gagal diubah...');
  </script>";
    header("location: ahligizi.php");
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
          <!-- Judul fitur -->
          <div class="row">

            <div class="col-xl-6 grid-margin stretch-card flex-column">
              <h1 class="mb-2 text-titlecase mb-4">Edit Data Ahligizi</h1>
            </div>
          </div>

          <!-- Form Ubah profil -->
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profil Ahligizi</h4>
                  <form class="forms-sample" action="" method="POST">
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Lengkap</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" value="<?= $row['FULLNAME_NUTRITIONIST'] ?>" name="nama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email" value="<?= $row['EMAIL_NUTRITIONIST'] ?>" name="email">
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputCity1">Tahun Pengalaman</label>
                      <input type="number" class="form-control" id="exampleInputCity1" placeholder="tahun" value="<?= $row['YEARS_OF_EXPERIENCE'] ?>" name="pengalaman">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Education</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="edukasi" value="<?= $row['EDUCATION'] ?>" name="edukasi">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">Sertifikasi</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="sertifikasi" value="<?= $row['CERTIFICATION'] ?>" name="sertifikasi">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="simpan">Simpan</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
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
<!-- Form Ubah profil -->
<!-- <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Profil Pengguna</h4>
                  <p class="card-description">
                    Lengkapi Data Profil Pengguna Berikut
                  </p>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputName1">Nama Lengkap</label>
                      <input type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail3">Email</label>
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword4">Tanggal Lahir</label>
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jenis Kelamin</label>
                      <select class="form-control" id="exampleSelectGender">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="img[]" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputCity1">City</label>
                      <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Textarea</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div> -->