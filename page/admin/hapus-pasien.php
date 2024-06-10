<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];

$row = mysqli_affected_rows($conn);

try {
    $query2 = "DELETE FROM `patient` WHERE `id_patient` = '$id'";
    $result2 = mysqli_query($conn, $query2);

    $query = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
    $result = mysqli_query($conn, $query);
    if ($row > 1) {
        $hapusKomen = true;
        $hapusArtikel = true;
    } else {
        $hapusArtikel = false;
        $hapusKomen = false;
    }
    echo "<script>
    alert('Data pasien berhasil dihapus...');
    window.location.href = 'pasien.php';
    </script>";
} catch (mysqli_sql_exception) {
    echo "<script>
    alert('Data pasien gagal dihapus...');
    window.location.href = 'pasien.php';
    </script>";}

