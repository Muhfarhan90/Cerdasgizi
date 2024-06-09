<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];
$row = mysqli_affected_rows($conn);
$pasienDelete = false;
$userDelete = false;
try {
    $query = "DELETE FROM `patient` WHERE `id_patient` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($row > 0) {
        $pasienDelete = true;
    } else {
        $pasienDelete = false;
    }
} catch (mysqli_sql_exception) {
}

try {
    $query2 = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
    $result2 = mysqli_query($conn, $query2);
    if ($row > 0) {
        $userDelete = true;
    } else {
        $userDelete = false;
    }
} catch (mysqli_sql_exception) {
}

if ($pasienDelete && $userDelete) {
    echo "<script>
    alert('Data pasien berhasil dihapus...');
    window.location.href = 'pasien.php';
    </script>";
} else {
    echo "<script>
    alert('Data pasien gagal dihapus...');
    window.location.href = 'pasien.php';
    </script>";
}
