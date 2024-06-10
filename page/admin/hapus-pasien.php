<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];


try {
    $query6 = "DELETE FROM `chat` WHERE `id_user` = '$id_user'";
    $result6 = mysqli_query($conn, $query6);
    $query3 = "DELETE FROM `consultation` WHERE `id_patient` = '$id'";
    $result3 = mysqli_query($conn, $query3);
    $query4 = "DELETE FROM `bmi_calculator` WHERE `id_patient` = '$id'";
    $result4 = mysqli_query($conn, $query4);
    $query5 = "DELETE FROM `comment` WHERE `id_patient` = '$id'";
    $result5 = mysqli_query($conn, $query5);
    $query = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
    $result = mysqli_query($conn, $query);
    $query2 = "DELETE FROM `patient` WHERE `id_patient` = '$id'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_affected_rows($conn);

    echo "<script>
    alert('Data pasien berhasil dihapus...');
    window.location.href = 'pasien.php';
    </script>";
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
