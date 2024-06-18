<?php
include("database/database.php");

// Mendapatkan nilai id_user terakhir
$query_last_id_user = "SELECT MAX(id_user) AS last_id_user FROM user";
$result_last_id_user = mysqli_query($conn, $query_last_id_user);
$row_last_id_user = mysqli_fetch_assoc($result_last_id_user);
$last_id_user = $row_last_id_user['last_id_user'];

// Mendapatkan nilai id_patient terakhir
$query_last_id_patient = "SELECT MAX(id_patient) AS last_id_patient FROM patient";
$result_last_id_patient = mysqli_query($conn, $query_last_id_patient);
$row_last_id_patient = mysqli_fetch_assoc($result_last_id_patient);
$last_id_nutritionist = $row_last_id_patient['last_id_patient'];

// Mengatur id_user dan id_nutritionist untuk data berikutnya
$id_user = $last_id_user + 1;
$id_patient = $last_id_nutritionist + 1;

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $nama = $_POST["nama_lengkap"];
    $tanggal = $_POST["tgl_lahir"];
    $gender = $_POST["gender"];
    $tinggi = $_POST["tinggi"];
    $berat = $_POST["berat"];
$check = isset($_POST["check"])?1:0;

    if($check == 0){
        echo "<script>
        alert('Anda harus menyetujui syarat dan ketentuan yang berlaku...')
        </script>";
        echo "<script>
        document.location.href = 'register.php';
        </script>";
        return false;
    }

    try {
        // Query untuk insert data user
        $query = "INSERT INTO user (id_user, id_role, username_user, password_user) VALUES ($id_user, 3, '$username', '$password')";

        // Query untuk insert data pasien
        $query2 = "INSERT INTO patient (id_patient, id_user, email_patient, fullname_patient, date_of_birth, gender, height, `weight`) VALUES ($id_patient, $id_user,'$email', '$nama', '$tanggal', '$gender', '$tinggi', '$berat')";

        // Eksekusi query
        $result = mysqli_query($conn, $query);
        $result2 = mysqli_query($conn, $query2);

        if ($result && $result2) {
            echo "<script>
            alert ('Registrasi pasien berhasil, Silahkan login kembali...')
            document.location.href = 'index.php';
        </script>";
        } else {
            echo "<script>
            alert ('Registrasi pasien gagal...')
        </script>";
        };
    } catch (mysqli_sql_exception) {
        echo "<script>
        alert('Username atau email anda sudah digunakan, Silahkan ganti username dan email lain...')
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
    <title>Register User</title>
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
                                <div class="brand-logo">
                                    <img src="./images/Cerdasgizi-ungu-removebg-preview.png" alt="logo">
                                </div>
                            </div>
                            <h4>Daftar Baru</h4>
                            <h6 class="font-weight-light">Silahkan isi data diri anda untuk mendaftar</h6>
                            <form class="pt-3" action="" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg " id="username" placeholder="Nama Lengkap" name="nama_lengkap" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg " id="username" placeholder="Username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <input type="date" class="form-control form-control-lg" id="tgl_lahir" placeholder="Tanggal lahir" name="tgl_lahir" required>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender" id="optionsRadios1" value="L">
                                                    Laki-laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="gender" id="optionsRadios2" value="P" checked>
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" id="tinggi" placeholder="Tinggi badan" name="tinggi" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" id="berat" placeholder="Berat badan" name="berat" required>
                                </div>
                                <div class="form-group">
                                    <div class="mb-4 mt-4">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" name="check" class="form-check-input">
                                                Saya setuju dengan Syarat dan Ketentuan yang berlaku
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="register">Daftar</button>
                                    </div>
                                    <div class="text-center mt-4 font-weight-light">
                                        Sudah memiliki akun? <a href="index.php" class="text-primary">Login</a>
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