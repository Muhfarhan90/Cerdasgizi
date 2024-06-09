<?php

include("database/database.php");
session_start();

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $query = "SELECT * FROM user WHERE username_user = '$username' AND password_user = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    // cek login
    $data = $result->fetch_assoc();
    $_SESSION['username_user'] = $data['USERNAME_USER'];
    $_SESSION['id_user'] = $data['ID_USER'];
    $_SESSION['is_login'] = true;
    // cek role
    $id_role = $data['ID_ROLE'];
    $_SESSION['id_role'] = $data['ID_ROLE'];
    // cek role
    if ($id_role == 1) {
      echo "<script>
      alert('Selamat Login Anda berhasil..');
      document.location.href= 'page/admin/dashboard-admin.php';
      </script>";
      // header("location: page/admin/dashboard-admin.php");
      exit();
    } else if ($id_role == 2) {
      echo "<script>
    alert('Selamat Login Anda berhasil..');
          document.location.href= 'page/ahligizi/dashboard-ahligizi.php';

      </script>";
      // header("location: page/ahligizi/dashboard-ahligizi.php");
      exit();
    } else {
      echo "<script>
      alert('Selamat Login Anda berhasil..');
            document.location.href= 'page/pasien/dashboard-pasien.php';
        </script>";
      // header('location: page/pasien/dashboard-pasien.php');
      exit();
    }
  } else {
    echo "<script>
    alert('Mohon maaf login ada gagal, Silahkan masukkan username dan password dengan benar');
      </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login User</title>
  <!-- base:css -->
  <link rel="stylesheet" href="./vendors/typicons/typicons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="./images/Cerdasgizi-ungu-removebg-preview.png" alt="logo">
              </div>
              <h4>Login untuk melanjutkan</h4>
              <h6 class="font-weight-light">Silahkan masukkan username dan password.</h6>
              <form class="pt-3" action="index.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputUsername" placeholder="Username" name="username" Required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" required>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="login">LOGIN</button>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <div class="text-center mt-4 font-weight-light">
                  Belum memiliki akun? <a href="register.php" class="text-primary">Buat akun</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>