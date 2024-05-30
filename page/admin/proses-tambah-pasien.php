<?php

include("../../database/database.php");
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


if (isset($_POST['tambah-pasien'])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tinggi = $_POST['tinggi_badan'];
    $berat = $_POST['berat_badan'];

    try {
        try {
            $query1 = "INSERT INTO user (id_user, id_role, username_user, password_user) VALUES ($id_user, 3, '$username', '$password')";
            $result = mysqli_query($conn, $query1);
        } catch (mysqli_sql_exception) {
            echo "Error pada query 1";
        }

        try {
            $query2 = "INSERT INTO patient (`id_patient`, `id_user`, `email_patient`, `fullname_patient`, `date_of_birth`, `gender`, `height`, `weight`) VALUES ('$id_patient', '$id_user', '$email', '$nama', '$tanggal_lahir', '$jenis_kelamin','$tinggi','$berat')";
            $result2 = mysqli_query($conn, $query2);
        } catch (mysqli_sql_exception) {
            echo "Error pada query 2";
        }

        $row = mysqli_affected_rows($conn);
        if ($row) {
            echo "<script>
                alert('Data berhasil ditambahkan...');
            </script>";
            header("location: pasien.php");
        } else {
            echo "<script>
            alert('Data gagal ditambahkan...');
        </script>";
            header("location: pasien.php");
        }
    } catch (mysqli_sql_exception) {
        echo "<script>
        alert('Username atau email sudah ada, gunakan username lain !');
        </script>";
    }
}
