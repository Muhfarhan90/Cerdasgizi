<?php

include("../../database/database.php");
// Mendapatkan nilai id_user terakhir
$query_last_id_user = "SELECT MAX(id_user) AS last_id_user FROM user";
$result_last_id_user = mysqli_query($conn, $query_last_id_user);
$row_last_id_user = mysqli_fetch_assoc($result_last_id_user);
$last_id_user = $row_last_id_user['last_id_user'];

// Mendapatkan nilai id_patient terakhir
$query_last_id_nutritionist = "SELECT MAX(id_nutritionist) AS last_id_nutritionist FROM nutritionist";
$result_last_id_nutritionist = mysqli_query($conn, $query_last_id_nutritionist);
$row_last_id_nutritionist = mysqli_fetch_assoc($result_last_id_nutritionist);
$last_id_nutritionist = $row_last_id_nutritionist['last_id_nutritionist'];

// Mengatur id_user dan id_nutritionist untuk data berikutnya
$id_user = $last_id_user + 1;
$id_nutritionist = $last_id_nutritionist + 1;

if (isset($_POST['tambah-ahligizi'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pengalaman = $_POST['pengalaman'];
    $pendidikan = $_POST['pendidikan'];
    $sertifikasi = $_POST['sertifikasi'];

    try {
        $query1 = "INSERT INTO user (id_user, id_role, username_user, password_user) VALUES ($id_user, 2, '$username', '$password')";
        $query2 = "INSERT INTO nutritionist (`id_nutritionist`, `id_user`, `email_nutritionist`, `fullname_nutritionist`, `years_of_experience`, `education`, `certification`) VALUES ('$id_nutritionist', '$id_user', '$email', '$nama', '$pengalaman', '$pendidikan', '$sertifikasi')";
        $result = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        $row = mysqli_affected_rows($conn);
        $row = mysqli_affected_rows($conn);
        if ($row) {
            echo "<script>
                alert('Data berhasil ditambahkan...');
                document.location.href = 'ahligizi.php';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambahkan...');
            ocument.location.href = 'ahligizi.php';

        </script>";
        }
    } catch(mysqli_sql_exception) {
        echo "<script>
        alert('Username atau email sudah ada, gunakan username lain !');
        </script>";
    }
   
}
