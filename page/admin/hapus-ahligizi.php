<?php
include("../../database/database.php");

$id = $_GET['id'];
$id_user = $_GET['id_user'];


try {
    $query6 = "DELETE FROM `chat` WHERE `id_user` = '$id_user'";
    $result6 = mysqli_query($conn, $query6);
    $query4 = "DELETE FROM `article` WHERE `id_nutritionist` = '$id'";
    $result4 = mysqli_query($conn, $query6);    
    $query3 = "DELETE FROM `consultation` WHERE `id_nutritionist` = '$id'";
    $result3 = mysqli_query($conn, $query3);
    $query = "DELETE FROM `user` WHERE `id_user` = '$id_user'";
    $result = mysqli_query($conn, $query);
    $query2 = "DELETE FROM `nutritionist` WHERE `id_nutritionist` = '$id'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_affected_rows($conn);

    echo "<script>
    alert('Data ahligizi berhasil dihapus...');
    window.location.href = 'ahligizi.php';
    </script>";
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
