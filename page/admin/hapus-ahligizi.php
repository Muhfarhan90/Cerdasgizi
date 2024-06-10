<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];

// Menghapus data dari tabel consultation terlebih dahulu jika tidak menggunakan ON DELETE CASCADE
$query1 = "DELETE FROM `consultation` WHERE `id_nutritionist` = '$id'";
$result1 = mysqli_query($conn, $query1);

if (!$result1) {
    echo "Error deleting consultations: " . mysqli_error($conn);
    exit;
}

// Menghapus data dari tabel nutritionist
$query2 = "DELETE FROM `nutritionist` WHERE `id_nutritionist` = '$id'";
$result2 = mysqli_query($conn, $query2);

if (!$result2) {
    echo "Error deleting nutritionist: " . mysqli_error($conn);
    exit;
}

// Menghapus data dari tabel user
$query3 = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
$result3 = mysqli_query($conn, $query3);

if ($result3) {
    echo "<script>
    alert('Data ahli gizi berhasil dihapus...');
    window.location.href = 'ahligizi.php';
    </script>";
} else {
    echo "<script>
    alert('Data ahli gizi gagal dihapus...');
    window.location.href = 'ahligizi.php';
    </script>";
}
